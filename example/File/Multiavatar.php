
<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\File\Multiavatar;
// 项目来源  https://multiavatar.com

//
$multiavatar = new Multiavatar();

// 基础使用
echo($multiavatar("李四", null, null));

// 去掉背景颜色
$avatarId = "小明";
echo($multiavatar($avatarId, true, null));

// 生成特定版本ABC，
echo($multiavatar($avatarId, null, array("part" => "11", "theme" => "A")));

// 数字标记
$avatarId = 123456789;
echo($multiavatar($avatarId, null, null));