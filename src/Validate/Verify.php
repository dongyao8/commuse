<?php

namespace Dongyao8\Commuse\Validate;


class Verify
{
    /**
     * 判断是否包含中文
     * @param $str
     * @return int
     */
    public static function checkHasChinese($str)
    {
        $len = preg_match('/[\x{4e00}-\x{9fa5}]+/u',$str);
        if ($len)
        {
            return true;
        }
        return false;
    }

    /**
     * 判断是否都是中文
     * @param $str
     * @return int
     */
    public static function checkAllChinese($str)
    {
        $len = preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str);
        if ($len)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证用户名
     * @param $username
     * @return bool
     */
    public static function checkUserName($username)
    {
        $search = '/^[a-zA-Z][-_a-zA-Z0-9]{5,15}$/';
        if (preg_match($search, $username)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证手机号
     * @param $tel
     * @return bool
     */
    public static function checkMobile($phone_number)
    {
        //中国联通号码：130、131、132、145（无线上网卡）、155、156、185（iPhone5上市后开放）、186、176（4G号段）、175（2015年9月10日正式启用，暂只对北京、上海和广东投放办理）,166,146
        //中国移动号码：134、135、136、137、138、139、147（无线上网卡）、148、150、151、152、157、158、159、178、182、183、184、187、188、198
        //中国电信号码：133、153、180、181、189、177、173、149，191，193，199
        $g = "/^1[34578]\d{9}$/";
        $g2 = "/^19[1389]\d{8}$/";
        $g3 = "/^166\d{8}$/";
        if (preg_match($g, $phone_number)) {
            return true;
        } else  if (preg_match($g2, $phone_number)) {
            return true;
        } else if (preg_match($g3, $phone_number)) {
            return true;
        }
        return false;
    }

    /**
     * 检测日期格式
     * @param $date
     * @return bool
     */
    public static function checkDateFormat($date)
    {
        //匹配日期格式
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $parts) && checkdate($parts[2], $parts[3], $parts[1])) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * 验证身份证号
     * @param $IDCard
     * @return bool
     */
    public static function checkIDCard($IDCard)
    {
        $preg_card = '/^\d{17}[\d|x]$|^\d{15}$/i';
        if (preg_match($preg_card, $IDCard)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证银行卡
     * 16-19 位卡号校验位采用 Luhn 校验方法计算：
     * 第一步：把信用卡号倒序（61789372994）
     * 第二步：取出倒序后的奇数位置上的号码， 相加等到总和s1。（eg:s1=6+7+9+7+9+4=42)
     * 第三步：取出倒序后的偶数位置上的号码，每个号码乘以2。   (eg:2,16,6,4,18)
     * 第四步：把第三步得到的大于10的号码转化为个位+十位。（eg:2,7,6,4,9)
     * 第五步：把处理好的偶数位号码相加，得到s2。 (eg:s2=2+7+6+4+9=28)
     *  第六步：判读(s1+s2)%10 == 0则有效，否则无效。（有效）
     * @param $card
     * @return bool
     */
    public static function checkBank($card)
    {
        $card = str_replace(' ','',$card);
        // step1 判断是否16到19位
        $pattern = '/^\d{16,19}$/';
        if (!preg_match($pattern,$card)) {
            return false;
        }

        // step2 luhn 算法校验
        $len = strlen($card);
        $sum = 0;
        for ($i = 0; $i < $len ; $i++)
        {
            if (($i + $len) & 1)
            { // 奇数
                $sum += ord($card[$i]) - ord('0');
            }
            else
            { // 偶数
                $tmp = (ord($card[$i]) - ord('0')) * 2;
                $sum += floor($tmp / 10) + $tmp % 10;
            }
        }

        return $sum % 10 === 0;
    }

    /**
     * 验证密码 6~16位，数字字母或下划线
     * @param $pwd
     * @return string
     */
    public static function checkPwd($pwd){
        $pattern= '/^[0-9a-z_]{6,16}$/i'; // i 不区分大小写
        if(preg_match($pattern,$pwd)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 匹配价格,重量等正整数或正小数
     * @param $num
     * @return bool
     */
    public static function checkDecimal($num) {
        // 可以匹配1.11,10.11  或 0.11
        if (preg_match('/^[1-9]+\d*(.\d{1,2})?$|^\d+.\d{1,2}$/',$num)) {  // ? 0次或1次, + 1次或多次, * 0次或多次
            return true;
        } else {
            return false;
        }
    }

    /**
     * 匹配正整数
     * @param $num
     * @return bool
     */
    public static function checkInteger($num) {
        // 不能小于0
        if (preg_match('/^[1-9]+\d*$/',$num)) {  // ? 0次或1次, + 1次或多次, * 0次或多次
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检测参数是否为数组
     * @param $array
     * @return string
     */
    public static function checkArray($array){
        if (is_array($array)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检测纳税人识别号
     * 15位、17位、18或者20位码
     * 字母全部大写
     * @param $str
     * @return string
     */
    public static function checkTax($str){
        $pattern= '/^[0-9A-Z]{15,20}$/'; // i 不区分大小写
        if(preg_match($pattern,$str)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Email
     * @param $str
     * @return false|int
     */
    public static function check_email($str)
    {
        return preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $str);
    }

    /**
     * 检测访问是否来自微信端
     * @return bool
     */
    public static function is_wechat()
    {
        return strpos($_SERVER ['HTTP_USER_AGENT'], 'MicroMessenger') !== false ? true : false;
    }

    /**
     * 固话
     * @param $num
     * @return bool
     */
    public static function check_telephone($num)
    {
        if (preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/', $num)) {
            return true;
        }
        return false;
    }

}
