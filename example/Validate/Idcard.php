<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\validate\Idcard;

$card = '110101200007285605'; //该身份证号为虚拟演示
$verify = new Idcard;
$checkres = $verify->getChinaIDCardXZ($card);
var_dump($checkres);