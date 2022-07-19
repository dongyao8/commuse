<?php
namespace Dongyao8\Commuse\File;

class Bing{

    // 获取必应每日壁纸
    public function dayimg()
    {
        $data =  json_decode(file_get_contents("https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1"),true);

        $days['images'] = 'https://www.bing.com'.$data['images'][0]['url'];
        $days['copyright'] = $data['images'][0]['copyright'];
        $days['title'] = $data['images'][0]['title'];
        return $days;
    }




}
