<?php

namespace Dongyao8\Commuse\Character;


class Timeformat
{

    /**
     * 根据生日计算年龄
     * @param string $birthday 生日
     * @return int 返回年龄
     */
    public function calcAge($birthday)
    {
        $age = empty($birthday) ? false : strtotime($birthday);
        if (!$age) {
            return 0;
        }
        list($y1, $m1, $d1) = explode("-", date("Y-m-d", $age));
        list($y2, $m2, $d2) = explode("-", date("Y-m-d"), time());
        $age = $y2 - $y1;
        if (intval($m2 . $d2) < intval($m1 . $d1)) {
            $age -= 1;
        }
        return $age;
    }



    /**
     * 计算两个日期的相差天数
     * @param string $date1 日期1
     * @param string $date1 日期2
     * @return int 返回相差的天数
     */
    function diffDays($date1, $date2)
    {
        return floor(abs(strtotime($date1) - strtotime($date2)) / 86400);
    }


    /**
     * 返回语义化时间
     * @param $date_time 时间
     * @param $type 1、'Y-m-d H:i:s' 2、时间戳
     * @param  $format 自定义事件格式
     * @example 
     *      format_datetime('2021-10-13') 返回 23 天前
     */
    public function format_datetime($date_time, $type = 1, $format = '')
    {
        if ($type == 1) {
            $timestamp = strtotime($date_time);
        } elseif ($type == 2) {
            $timestamp = $date_time;
            $date_time = date('Y-m-d H:i:s', $date_time);
        }
        if ($format) {
            return date($format, $timestamp);
        }
        $difference = time() - $timestamp;
        if ($difference <= 180) {
            return '刚刚';
        } elseif ($difference <= 3600) {
            return ceil($difference / 60) . '分钟前';
        } elseif ($difference <= 86400) {
            return ceil($difference / 3600) . '小时前';
        } elseif ($difference <= 2592000) {
            return ceil($difference / 86400) . '天前';
        } elseif ($difference <= 31536000) {
            return ceil($difference / 2592000) . '个月前';
        } else {
            // 大于一年前显示标准时间格式
            $year = ceil($difference / 31536000);
            if ($year > 1) {
                return  $date_time;
            } else {
                return  $year . '年前';
            }

            //return $date_time;
        }
    }
}
