# 日常使用类库
 该项目用于收录整理日常开发所需的常用功能类库，目前处于初级阶段，欢迎各位朋友提供代码，一起维护，让开发变得更简单。
***
### 使用方法[推荐]
稳定版本：
``` 
    composer require dongyao8/commuse
```
开发版本：
``` 
    composer require dongyao8/commuse dev-main
```

### 升级办法

``` 
    composer update dongyao8/commuse
```
***
### 相关栏目

- 字符类
- 加密解密类
- 文件处理类
- 网络通信类
- 验证类
- 持续更新中……

***

### 使用说明

|   目录   |  文件名  |  描述   |
| ------- | ------- |-------  |
| \Character | Moneyts.php | 金额数额转换人民币大写值|
| \Character | Pinyin.php| 汉字转拼音|
| \Character | Timeformat.php| 时间格式语义化|
| \Crypto |  Aes.php     | Aes加密解密 |
| \Crypto |  Asymmetric.php|  非对称相关计算方法 |
| \Crypto |Base64.php | 区别与base64_encode，此方法为安全的base64加密 |
| \File |  Filehandle.php     | 文件处理相关方法 |
| \Network | Getip.php| 获取客户端IP地址 |
| \Validate | Verify.php| 常用的一些字段验证 |
| 持续更新中 | 持续更新中| 持续更新中…… |


### 使用示例
- 金额处理：
```php
    <?php
    require_once('../../vendor/autoload.php');
    use Dongyao8\Commuse\Character\Moneyts;


    $ip = new Moneyts;
    echo $ip->rmb('156.33');
```
> 得到输出结果：壹佰伍拾陆元叁角叁分

- 金额处理：
```php
    <?php
    require_once('../../vendor/autoload.php');
    use Dongyao8\Commuse\Crypto\Aes;
      
    $str = '这个工具很好用';
    $aes = new Aes('12345678');
    // 加密
    $encrypted = $aes->encrypt($str);
    echo '要加密的字符串：'.$str.'<br>加密后的字符串：', $encrypted, '<hr>';
    // 解密
    $decrypted = $aes->decrypt($encrypted);
    echo '要解密的字符串：', $encrypted, '<br>解密后的字符串：', $decrypted;
```
> 要加密的字符串：这个工具很好用  
> 加密后的字符串：85d61MYsItXd81sPW5e3fxY8oONzlOHyOJBOy8P57CY=  
> 要解密的字符串：85d61MYsItXd81sPW5e3fxY8oONzlOHyOJBOy8P57CY=  
> 解密后的字符串：这个工具很好用  
***
