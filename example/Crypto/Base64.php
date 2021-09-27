<?php

require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Crypto\Base64;


$base64 = new Base64;

$str = '安全的base64内容';

echo '要Base64的字符串：'.$str.'<br>加密后的字符串：', $base64->urlsafe_b64encode($str), '<hr>';

