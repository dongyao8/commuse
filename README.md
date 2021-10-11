# 日常使用类库
 该项目用于收录整理日常开发所需的常用功能类库，目前处于初级阶段，欢迎各位朋友提供代码，一起维护，让开发变得更简单。
***
### 使用方法[推荐]

``` 
    composer require dongyao8/commuse
```

### 升级办法

``` 
    composer update dongyao8/commuse
```
***

### 使用说明

|   目录   |  文件名  |  描述   |
| ------- | ------- |-------  |
| \Character | Moneyts.php | 金额数额转换人民币大写值|
| \Character | Pinyin.php| 汉字转拼音|
| \Crypto |  Aes.php     | Aes加密解密 |
| \Crypto |  Asymmetric.php|  非对称相关计算方法 |
| \Crypto |Base64.php | 区别与base64_encode，此方法为安全的base64加密 |
| \Network | Getip.php| 获取客户端IP地址 |
| \Validate | Verify.php| 常用的一些字段验证 |
| 持续更新中 | 持续更新中| 持续更新中…… |


### 使用示例

```php
    <?php
    require_once('../../vendor/autoload.php');
    use Dongyao8\Commuse\Character\Moneyts;


    $ip = new Moneyts;
    echo $ip->rmb('156.33');
```
> 得到输出结果：壹佰伍拾陆元叁角叁分
***
