<?php

namespace Dongyao8\Commuse\network;


class Getip
{
    /**
     * 安全的获取客户端IP
     * @return string
     */
    public static function safeip()
    {
        if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                    $ip = $_SERVER["REMOTE_ADDR"];
                } else {
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                            "unknown")
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
}
