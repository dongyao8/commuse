
<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\File\Image;

$image = new Image;
//生成字母头像

$name = 'clark';
$base64Img = $image->letter_avatar($name);
//该方式生成的是SVG格式，注意引用方式
echo '<object data="'.$base64Img.'"/>';
