<?php

namespace Dongyao8\Commuse\Character;


class Moneyts
{
    /**
     * 人民币大写转换
     * @return string
     */
    public static function rmb($num)
    {
        $d = array("零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖");
        $e = array('元', '拾', '佰', '仟', '万', '拾万', '佰万', '仟万', '亿', '拾亿', '佰亿', '仟亿');
        $p = array('分', '角');
        $zheng = "整";
        $final = array();
        $inwan = 0; //是否有万 
        $inyi = 0; //是否有亿 
        $len = 0; //小数点后的长度 
        $y = 0;
        $num = round($num, 2); //精确到分 
        if (strlen($num) > 15) {
            return "金额太大";
            die();
        }
        if ($c = strpos($num, '.')) { //有小数点,$c为小数点前有几位 
            $len = strlen($num) - strpos($num, '.') - 1; //小数点后有几位数 
        } else { //无小数点 
            $c = strlen($num);
            $zheng = '整';
        }
        for ($i = 0; $i < $c; $i++) {
            $bit_num = substr($num, $i, 1);
            if ($bit_num != 0 || substr($num, $i + 1, 1) != 0) {
                @$low = $low . $d[$bit_num];
            }
            if ($bit_num || $i == $c - 1) {
                @$low = $low . $e[$c - $i - 1];
            }
        }
        if ($len != 1) {
            for ($j = $len; $j >= 1; $j--) {
                $point_num = substr($num, strlen($num) - $j, 1);
                @$low = $low . $d[$point_num] . $p[$j - 1];
            }
        } else {
            $point_num = substr($num, strlen($num) - $len, 1);
            $low = $low . $d[$point_num] . $p[$len];
        }
        $chinses = str_split($low, 3); //字符串转化为数组 
        for ($x = count($chinses) - 1; $x >= 0; $x--) {
            if ($inwan == 0 && $chinses[$x] == $e[4]) { //过滤重复的万 
                $final[$y++] = $chinses[$x];
                $inwan = 1;
            }
            if ($inyi == 0 && $chinses[$x] == $e[8]) { //过滤重复的亿 
                $final[$y++] = $chinses[$x];
                $inyi = 1;
                $inwan = 0;
            }
            if ($chinses[$x] != $e[4] && $chinses[$x] !== $e[8]) {
                $final[$y++] = $chinses[$x];
            }
        }
        $newstr = (array_reverse($final));
        $nstr = join($newstr);
        if ((substr($num, -2, 1) == '0') && (substr($num, -1) <> 0)) {
            $nstr = substr($nstr, 0, (strlen($nstr) - 6)) . '零' . substr($nstr, -6, 6);
        }
        $nstr = (strpos($nstr, '零角')) ? substr_replace($nstr, "", strpos($nstr, '零角'), 6) : $nstr;
        return $nstr = (substr($nstr, -3, 3) == '元') ? $nstr . $zheng : $nstr;
    }
}
