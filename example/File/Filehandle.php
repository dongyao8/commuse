<?php
require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\File\Filehandle;


$file = new Filehandle;


/**
 * PHP 高效遍历文件夹（大量文件不会卡死，带文件名排序功能）
 * @param string $path 目录路径
 * @param integer $level 目录深度层级
 * @param boolean $showfile 是否显示文件(否则只遍历显示目录)
 * @param array $skips 要忽略的文件路径集合
 * @param integer $deepth 扫描深度
 */

$path = '../';

var_dump($file->fastScanDir($path, $level = 0, $showfile = true, $skips = array(), $deepth = 0));
