<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Network\Getip;


// 获取客户端IP地址，本地localhost  ::1；
echo Getip::getNetMask('127.0.0.1');