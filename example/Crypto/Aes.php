<?php

require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Crypto\Aes;

$str = '这个工具很好用';
$aes = new Aes('12345678');
$encrypted = $aes->encrypt($str);

echo '要加密的字符串：'.$str.'<br>加密后的字符串：', $encrypted, '<hr>';
 
$decrypted = $aes->decrypt($encrypted);
 
echo '要解密的字符串：', $encrypted, '<br>解密后的字符串：', $decrypted;