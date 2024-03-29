# 日常使用类库
 该项目用于收录整理日常开发所需的常用功能类库，欢迎各位朋友提供代码，一起维护，让开发变得更简单。
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
- 图片处理
- 验证类
- 持续更新中……

***

### 使用说明

|   目录   | 文件名            | 描述                            | 发布版本  |
| ------- |----------------|----------------------------------|---------------|
| \Character | Moneyts.php    | 金额数额转换人民币大写值  |1.0.0  |
| \Character | Pinyin.php     | 汉字转拼音   |1.0.0  |
| \Character | Timeformat.php | 时间格式语义化 |1.0.0  |
| \Crypto | Aes.php        | Aes加密解密   |1.0.0  |
| \Crypto | Asymmetric.php | 非对称相关计算方法 |1.0.0  |
| \Crypto | Base64.php     | 区别与base64_encode，此方法为安全的base64加密 |1.0.0  |
| \Crypto | Jwt.php        | Jwt接口验证类  |1.0.2  |
| \File | Filehandle.php | 文件处理相关方法  |1.0.1  |
| \File | Image.php      | 图片处理     |1.0.2  |
| \File | Multiavatar.php      | 随机生成用户头像     |1.0.3  |
| \File | Bing.php      | 获取每日壁纸     |1.0.4  |
| \Network | Getip.php      | 网络IP相关验证检测  |1.0.0  |
| \Validate | Verify.php     | 常用的一些字段验证    |1.0.0  |
| \Validate | Idcard.php     | 身份证信息提取，年龄，省份，星座等   |1.0.6 |
| 持续更新中 | 持续更新中          | 持续更新中……     | ……  |


### 使用示例
> 所有方法在example文件夹中有对应的使用方法演示，部分参照如下：

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

## 由 JetBrains 赞助

[![](https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.svg)](https://www.jetbrains.com/?from=https://github.com/dongyao8/commuse)

## 免责声明

DYcms程序是免费开源的产品，仅用于学习交流使用！       
不可用于任何违反`中华人民共和国(含台湾省)`或`使用者所在地区`法律法规的用途。      
因为作者即本人仅完成代码的开发和开源活动`(开源即任何人都可以下载使用)`，从未参与用户的任何运营和盈利活动。    
且不知晓用户后续将`程序源代码`用于何种用途，故用户使用过程中所带来的任何法律责任即由用户自己承担。

### License

Licensed under the [MIT license](LICENSE).
