<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\validate\Verify;

$name = 'test123';
$verify = new Verify;
$checkres = $verify::checkHasChinese($name);
var_dump($checkres);