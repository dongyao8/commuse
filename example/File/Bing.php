
<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\File\Bing;

$bing = new Bing;
//获取每日壁纸
var_dump($bing->dayimg());
