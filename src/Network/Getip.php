<?php

namespace Dongyao8\Commuse\Network;


class Getip
{
    /**
     * 安全的获取客户端IP
     * @return string
     */
    public static function safeip()
    {
        error_reporting(0);
        if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                    $ip = $_SERVER["REMOTE_ADDR"];
                } else {
                    if (
                        isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp(
                            $_SERVER['REMOTE_ADDR'],
                            "unknown"
                        )
                    ) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $ip = "unknown";
                    }
                }
            }
        }
        return ($ip);
    }

    /**
     * 判断 IP 地址是否在给定的网段内
     * @param string $ipAddress IP 地址. 127.0.0.1
     * @param string $range     IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
     * @SuppressWarnings(PHPMD)
     * @see https://www.pgregg.com/projects/php/ip_in_range/
     */
    public static function v4InRange(string $ipAddress, string $range): bool
    {
        if (\str_contains($range, '/')) {
            // $range is in IP/NETMASK format
            $rangeParts = \explode('/', $range, 2);
            $range      = $rangeParts[0] ?? '';
            $netMask    = $rangeParts[1] ?? '';

            if (\str_contains($netMask, '.')) {
                // $netMask is a 255.255.0.0 format
                $netMask    = \str_replace('*', '0', $netMask);
                $netMaskDec = \ip2long($netMask);

                return (\ip2long($ipAddress) & $netMaskDec) === (\ip2long($range) & $netMaskDec);
            }

            // $netMask is a CIDR size block
            // fix the range argument
            $blocks = \explode('.', $range, 4);

            $range = \sprintf(
                '%u.%u.%u.%u',
                (int)($blocks[0] ?? 0),
                (int)($blocks[1] ?? 0),
                (int)($blocks[2] ?? 0),
                (int)($blocks[3] ?? 0),
            );

            $rangeDec = \ip2long($range);
            $ipDec    = \ip2long($ipAddress);

            $netMask     = (int)$netMask;
            $wildcardDec = (2 ** (32 - $netMask)) - 1;
            $netMaskDec  = ~$wildcardDec;

            return ($ipDec & $netMaskDec) === ($rangeDec & $netMaskDec);
        }

        // range might be 255.255.*.* or 1.2.3.0-1.2.3.255
        if (\str_contains($range, '*')) { // a.b.*.* format
            // Just convert to A-B format by setting * to 0 for A and 255 for B
            $lower = \str_replace('*', '0', $range);
            $upper = \str_replace('*', '255', $range);
            $range = "{$lower}-{$upper}";
        }

        if (\str_contains($range, '-')) { // A-B format
            $rangeParts = \explode('-', $range, 2);
            $lower      = $rangeParts[0] ?? '';
            $upper      = $rangeParts[1] ?? '';

            $lowerDec = (float)\sprintf('%u', (int)\ip2long($lower));
            $upperDec = (float)\sprintf('%u', (int)\ip2long($upper));
            $ipDec    = (float)\sprintf('%u', (int)\ip2long($ipAddress));

            return ($ipDec >= $lowerDec) && ($ipDec <= $upperDec);
        }

        return false;
    }


    /**
     * 获取 ip 地址对应的子网掩码. For example, '192.0.0.0' => '255.255.255.0'.
     */
    public static function getNetMask(string $ipAddress): ?string
    {
        $ipAddressLong = \ip2long($ipAddress);

        $maskLevel1 = 0x80000000;
        $maskLevel2 = 0xC0000000;
        $maskLevel3 = 0xE0000000;

        $resultMask = 0xFFFFFFFF;
        if (($ipAddressLong & $maskLevel1) === 0) {
            $resultMask = 0xFF000000;
        } elseif (($ipAddressLong & $maskLevel2) === $maskLevel1) {
            $resultMask = 0xFFFF0000;
        } elseif (($ipAddressLong & $maskLevel3) === $maskLevel2) {
            $resultMask = 0xFFFFFF00;
        }

        $result = \long2ip($resultMask);

        // @phpstan-ignore-next-line
        return $result ?: null;
    }

    /**
     * 隐藏ip v4地址的中间两位
     * @param  string $ip_v4 ipV4的地址
     * @return string 处理隐藏后的地址
     */
    public static function hide_ipv4($ip_v4)
    {
        $ip = explode('.', $ip_v4);
        if (count($ip) == 4) {
            $ip[1] = '**';
            $ip[2] = '**';
            return implode('.', $ip);
        }
        return $ip_v4;
    }
}
