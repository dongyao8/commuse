<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Character\Pinyin;


$ip = new Pinyin;

$s = '哈哈';  //要转换的汉字
$quanpin = true; //是否全拼
$daxie = true;  // 首字母是否大写
echo $ip->getpy($s, $quanpin, $daxie);