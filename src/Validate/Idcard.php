<?php

namespace Dongyao8\Commuse\Validate;


class Idcard
{
    public $aWeight = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2]; // 十七位数字本体码权重
    public $aValidate = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2']; // mod11,对应校验码字符值
    public $birthday;
    public $sex;
    /**
     * @desc  验证出生日期
     * @param $iY
     * @param $iM
     * @param $iD
     * @return bool
     */
    public function isChinaIDCardDate($iY, $iM, $iD): bool
    {
        $iDate    = $iY . '-' . $iM . '-' . $iD;
        $rPattern = '/^(([0-9]{2})|(19[0-9]{2})|(20[0-9]{2}))-((0[1-9]{1})|(1[012]{1}))-((0[1-9]{1})|(1[0-9]{1})|(2[0-9]{1})|3[01]{1})$/';
        if (preg_match($rPattern, $iDate, $arr)) {
            $this->birthday = $iDate;
            return true;
        }
        return false;
    }
    /**
     * @desc  根据身份证号前17位, 算出识别码
     * @param $id
     * @return mixed|string
     */
    public function getValidateCode($id)
    {
        $id17 = substr($id, 0, 17);
        $sum  = 0;
        $len  = strlen($id17);
        for ($i = 0; $i < $len; $i++) {
            $sum += $id17[$i] * $this->aWeight[$i];
        }
        $mode = $sum % 11;
        return $this->aValidate[$mode];
    }
    /**
     * @desc  验证身份证号
     * @param $id
     * @return bool
     */
    public function isChinaIDCard($id): bool
    {
        if (!$this->get_province($id)) {
            return false;
        }
        $len = strlen($id);
        if ($len == 18) {
            if (!$this->isChinaIDCardDate(substr($id, 6, 4), substr($id, 10, 2), substr($id, 12, 2))) {
                return false;
            }
            $code = $this->getValidateCode($id);
            if (strtoupper($code) == substr($id, 17, 1)) {
                return true;
            }
            return false;
        } else if ($len == 15) {
            if (!$this->isChinaIDCardDate('19' . substr($id, 6, 2), substr($id, 8, 2), substr($id, 10, 2))) {
                return false;
            }
            if (!is_numeric($id)) {
                return false;
            }
            return true;
        }
        return false;
    }
    /**
     * @desc  根据身份证号，自动返回对应的性别
     * @param $cid
     * @return string
     */
    public function getChinaIDCardSex($cid): string
    {
        $sexInt = (int)substr($cid, 16, 1);
        return $sexInt % 2 === 0 ? '女' : '男';
    }
    /**
     * @desc  根据身份证号，自动返回对应的星座
     * @param $cid
     * @return string
     */
    public function getChinaIDCardXZ($cid): string
    {
        $bir      = substr($cid, 10, 4);
        $month    = (int)substr($bir, 0, 2);
        $day      = (int)substr($bir, 2);
        $strValue = '';
        if (($month == 1 && $day <= 21) || ($month == 2 && $day <= 19)) {
            $strValue = '水瓶座';
        } else if (($month == 2 && $day > 20) || ($month == 3 && $day <= 20)) {
            $strValue = '双鱼座';
        } else if (($month == 3 && $day > 20) || ($month == 4 && $day <= 20)) {
            $strValue = '白羊座';
        } else if (($month == 4 && $day > 20) || ($month == 5 && $day <= 21)) {
            $strValue = '金牛座';
        } else if (($month == 5 && $day > 21) || ($month == 6 && $day <= 21)) {
            $strValue = '双子座';
        } else if (($month == 6 && $day > 21) || ($month == 7 && $day <= 22)) {
            $strValue = '巨蟹座';
        } else if (($month == 7 && $day > 22) || ($month == 8 && $day <= 23)) {
            $strValue = '狮子座';
        } else if (($month == 8 && $day > 23) || ($month == 9 && $day <= 23)) {
            $strValue = '处女座';
        } else if (($month == 9 && $day > 23) || ($month == 10 && $day <= 23)) {
            $strValue = '天秤座';
        } else if (($month == 10 && $day > 23) || ($month == 11 && $day <= 22)) {
            $strValue = '天蝎座';
        } else if (($month == 11 && $day > 22) || ($month == 12 && $day <= 21)) {
            $strValue = '射手座';
        } else if (($month == 12 && $day > 21) || ($month == 1 && $day <= 20)) {
            $strValue = '魔羯座';
        }
        return $strValue;
    }
    /**
     * @desc  根据身份证号，自动返回对应的生肖
     * @param $cid
     * @return string
     */
    public function getChinaIDCardSX($cid): string
    {
        $start = 1901;
        $end   = $end = (int)substr($cid, 6, 4);
        $x     = ($start - $end) % 12;
        $value = '';
        if ($x == 1 || $x == -11) {
            $value = '鼠';
        }
        if ($x == 0) {
            $value = '牛';
        }
        if ($x == 11 || $x == -1) {
            $value = '虎';
        }
        if ($x == 10 || $x == -2) {
            $value = '兔';
        }
        if ($x == 9 || $x == -3) {
            $value = '龙';
        }
        if ($x == 8 || $x == -4) {
            $value = '蛇';
        }
        if ($x == 7 || $x == -5) {
            $value = '马';
        }
        if ($x == 6 || $x == -6) {
            $value = '羊';
        }
        if ($x == 5 || $x == -7) {
            $value = '猴';
        }
        if ($x == 4 || $x == -8) {
            $value = '鸡';
        }
        if ($x == 3 || $x == -9) {
            $value = '狗';
        }
        if ($x == 2 || $x == -10) {
            $value = '猪';
        }
        return $value;
    }
    /**
     * @desc  根据身份证号，自动返回对应的省、自治区、直辖市代
     * @param $id
     * @return string
     */
    public function get_province($id): string
    {
        $index = substr($id, 0, 2);
        $area  = [
            11 => '北京', 12 => '天津', 13 => '河北', 14 => '山西', 15 => '内蒙古', 21 => '辽宁',
            22 => '吉林', 23 => '黑龙江', 31 => '上海', 32 => '江苏', 33 => '浙江', 34 => '安徽',
            35 => '福建', 36 => '江西', 37 => '山东', 41 => '河南', 42 => '湖北', 43 => '湖南',
            44 => '广东', 45 => '广西', 46 => '海南', 50 => '重庆', 51 => '四川', 52 => '贵州',
            53 => '云南', 54 => '西藏', 61 => '陕西', 62 => '甘肃', 63 => '青海', 64 => '宁夏',
            65 => '新疆', 71 => '台湾', 81 => '香港', 82 => '澳门', 91 => '国外'
        ];
        return $area[$index];
    }
}
