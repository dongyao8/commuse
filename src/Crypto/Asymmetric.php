<?php

namespace Dongyao8\Commuse\Crypto;

// 非对称计算相关方法


class Asymmetric
{
    //生成签名
    public function getSign($content, $privateKey , $method = OPENSSL_ALGO_SHA256)
    {
        $isOK = openssl_sign($content, $sign, $privateKey, $method);
        if ($isOK) {
            return base64_encode($sign);
        }else{
            return false;
        }
    }

    //验证签名是否正确
    public function verify($content, $sign, $publicKey, $method = OPENSSL_ALGO_SHA256)
    {
        $verify = openssl_verify($content, base64_decode($sign), $publicKey, $method);
        return $verify;
    }

    // 生成密钥证书
    // certpath PHP扩展openssl的openssl.cnf绝对路径:示例：/Applications/MAMP/Library/OpenSSL/openssl.cnf

    public function createkey($certpath, $size = 2048, $type = 'OPENSSL_KEYTYPE_RSA')
    {
        header("Content-type:text/html;charset=utf-8");
        $config = array(
            "private_key_bits" => $size,                     //字节数    512 1024  2048   4096 等
            "private_key_type" => $type,     //加密类型
            "config" => $certpath
        );
        $res = openssl_pkey_new($config);
        openssl_pkey_export($res, $pri, null, $config);
        $d = openssl_pkey_get_details($res);
        $pub = $d['key'];
        var_dump($pri, $pub);
        die;
    }

    // 全部参数按字母排序
    public function dataSortAndKeyVal(array $data)
    {
        ksort($data);
        $strTmp = [];
        foreach ($data as $key => $val) {
            $strTmp[] = $key . '=' . $val;
        }
        return join('&', $strTmp);
    }

    /** 用私钥加密
     * @param $data
     * @return null|string
     */
    public function privEncrypt($data,$privateKey)
    {
        if (!is_string($data)) {
            return null;
        }
        $result = openssl_private_encrypt($data, $encrypted, $privateKey);
        if ($result) {
            return base64_encode($encrypted);
        }
        return null;
    }

    /** 私钥解密
     * @param $encrypted
     * @return null
     */
    public function privDecrypt($encrypted,$privateKey)
    {
        if (!is_string($encrypted)) {
            return null;
        }
        $encrypted = base64_decode($encrypted);
        $result = openssl_private_decrypt($encrypted, $decrypted,$privateKey);
        if ($result) {
            return $decrypted;
        }
        return null;
    }

    /** 公钥加密
     * @param $data
     * @return null|string
     */
    public function pubEncrypt($data, $publicKey)
    {
        if (!is_string($data)) {
            return null;
        }
        $result = openssl_public_encrypt($data, $encrypted, $publicKey);
        if ($result) {
            return base64_encode($encrypted);
        }
        return null;
    }

    /** 公钥解密
     * @param $crypted
     * @return null
     */
    public function pubDecrypt($crypted, $publicKey)
    {
        if (!is_string($crypted)) {
            return null;
        }
        $crypted = base64_decode($crypted);
        $result = openssl_public_decrypt($crypted, $decrypted, $publicKey);
        if ($result) {
            return $decrypted;
        }
        return null;
    }
}
