<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Character\Moneyts;


$ip = new Moneyts;
echo $ip->rmb('156.33');