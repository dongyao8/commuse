<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Character\Timeformat;


$time = new Timeformat;


// 根据生日计算年龄
$birth = '1999-01-05';
echo '生日是：'.$birth."的朋友，当前年龄为：".$time->calcAge($birth)."岁";
echo "<hr>";

// 语义化时间格式
echo $time->format_datetime('2021-10-13 18:12:03');
echo "<hr>";

// 两个日期间隔时间
echo '建国以来，距今天一共经过了：'.$time->diffDays('1949-10-01 14:00:00',date('Y-m-d H:i:s')) . "天";