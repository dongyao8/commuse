<?php

namespace Dongyao8\Commuse\File;


class Filehandle
{
    /**
     * PHP 高效遍历文件夹（大量文件不会卡死，带文件名排序功能）
     * @param string $path 目录路径
     * @param integer $level 目录深度层级
     * @param boolean $showfile 是否显示文件(否则只遍历显示目录)
     * @param array $skips 要忽略的文件路径集合
     * @param integer $deepth 扫描深度
     */
    public function fastScanDir($path = './', $level = 0, $showfile = true, $skips = array(), $deepth = 0)
    {
        if (!file_exists($path) || ($deepth && $level > $deepth)) {
            return array();
        }
        $path = str_replace('//', '/', $path . '/');
        $file = new \FilesystemIterator($path);
        $filename = '';
        $icon = ''; // 树形层级图形
        if ($level > 0) {
            $icon = ('|' . str_repeat('--', $level));
        }
        $outarr = array();
        foreach ($file as $fileinfo) {
            $filename = iconv('GBK', 'utf-8', $fileinfo->getFilename()); // 解决中文乱码
            $filepath = $path . $filename;
            if ($fileinfo->isDir()) {
                if (!($skips && in_array($filepath . '/', $skips))) {
                    $outarr[$filename] = array('path' => $filepath, 'type' => 'dir', 'icon' => $icon);
                    $outarr[$filename]['children'] = $this->fastScanDir($filepath, $level + 1, $showfile);
                }
                continue;
            }
            if ($showfile && !($skips && !in_array($filepath, $skips))) {
                $outarr[$filename] = array('path' => $filepath, 'type' => 'file', 'icon' => $icon);
            }
        }
        if ($outarr) {
            ksort($outarr);
        }
        return $outarr;
    }
}
