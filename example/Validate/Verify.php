<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\validate\Verify;

$mobile = '16702030405';
$verify = new Verify;
$checkres = $verify::checkMobile($mobile);
var_dump($checkres);