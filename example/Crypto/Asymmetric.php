<?php

require_once('../../vendor/autoload.php');

use Dongyao8\Commuse\Crypto\Asymmetric;


$asy = new Asymmetric;



$path = '/Applications/MAMP/Library/OpenSSL/openssl.cnf';

// $asy->createkey($path);

$pk = '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDAUVVMUUEB1yuo
3IWIeMCEda0eKLmCYLov3B+B9UOb9v9PqHgRLJep5CXy+SMc5AGXAWGlX2tRcRWU
D3T2q3VXxmvbWtWiAoWEptYx5P+o2cIB0bzQ3qXfusPgOR4mQ50sXb4LE2fVqiW2
BIrffz1iecr1W1cT3qmCLybEiOGavKcLseYd7DgBQ8fYBdW+Fs26RtixSGncijtE
8GjmO8ofBs/cy5oljTx9FSGr49FzLQna5VqB9zXh0Bza9qXtByvIjXDKA3C4+UbN
N6ODxB0CkvBXBtoupTvPhXfk5YVWrankMbs+0eFxwFEjWp9/UnC+6pCn4jShuNa+
7471DsEHAgMBAAECggEANGj12ep60MmWuFoAegSOUorPNtzaUVGS6+ANJhl051gU
k9zRe7yvSDlIrkJ+8yyf0ksqFSs/z94Fh2f+9Aod3GHSmuDSP2h4goIE9Wv20Ekn
ud8ymalTgvke0EhAkyTx/Fk/pT0QmwXXaRcr0WSXkfKnAN53iI6xmyzGX+D9unEe
CFiRr7wKIYQYeH/+9Gp3nFt2/mFaYCnpWD8QCHhkVYtEOFzrROlpseZr7F+hajy1
pmtRve0WjV3KFX2Qkhiq+CEpawBSniFuF+JNl5VMU0q0jkGGqqIyHgIOVCj+MPg+
XgzjQTDLniLFfWAYz7+o/D/V9Bxu471LOtula7O9QQKBgQDkTM42M5W9kMQy74YV
9DYTdkgvfoewL3W7kHL4oZE5SGAf1cvKt08bEXY9WEkG3dI19Zb7nM9jarrFM47K
I15ZLqbPOvwEDkymQ8QMcf9Fjd5ef2F9bs2zO/XkFbZ8kPNRD+QsEi/u2L3wk9ui
UHrJnSXHJwDke+s4Xwhti0WqWQKBgQDXpuLa+DAm4VvVZr5d2tQdEgMVw5Nc1EsA
rW6Vtu2xfdhfIhowh5MtldFDWQAiOLqFarXblJ3szdN4+c0GZHIcJnvopsxKAFT1
fQESQUIP7BchZR5TWBxhwf/kN+MIK7++95MWdGpDkd2S11BYLPGOxBJjC/9e8AU/
imdxHjOaXwKBgEIov9mVOV+mBDV+lCzoiIM7U8/vqwKzvjqMscS7jYo8Hx8apeQp
GxONC+bbHs6OmcxpT0e7OZ5l35omRsrtVPojOtPzE/VY731/ReEVaBSP+FEKOQZQ
hevbBHcEk82lc92Z7VWYL6vXw7NkJdHz4KFsmPYNp4SPJKtBXv/fzGCBAoGBAKp0
1TezmYwB8a66aZqSD7tys1GOp3pmq2o7q/9W+oajLFX2BLF7WFBd7WzIepySLoyq
jlikHjhBcPhcqzx0ROYPXT3GKhAMNxtb1W7yeh9Pw/C3lsLWEIkM6REhQ6j/u65c
zryfBCeosnUREAbCb6UjQk1b/Fy0Z9GTurPk5XENAoGBAKuh9gsx42SZmaL+CWrU
ACYtBO7Sc9FpTyjVi/tY3NovGuX+0DnEQ8ha16vRAYiZ2skgIxFKFedHpCbBOaFL
Asc0Ed0kohpcduEcFvhtWtEt3efNgP7lhBgWjFUKJgM5fuTQ5yeJZjBIneCiLEfU
ITnHOMXE21yXWa+mi5inr9Ao
-----END PRIVATE KEY-----';

$gk = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwFFVTFFBAdcrqNyFiHjA
hHWtHii5gmC6L9wfgfVDm/b/T6h4ESyXqeQl8vkjHOQBlwFhpV9rUXEVlA909qt1
V8Zr21rVogKFhKbWMeT/qNnCAdG80N6l37rD4DkeJkOdLF2+CxNn1aoltgSK3389
YnnK9VtXE96pgi8mxIjhmrynC7HmHew4AUPH2AXVvhbNukbYsUhp3Io7RPBo5jvK
HwbP3MuaJY08fRUhq+PRcy0J2uVagfc14dAc2val7QcryI1wygNwuPlGzTejg8Qd
ApLwVwbaLqU7z4V35OWFVq2p5DG7PtHhccBRI1qff1JwvuqQp+I0objWvu+O9Q7B
BwIDAQAB
-----END PUBLIC KEY-----';



$str = '123'; //明文内容

echo '签名内容：' . $sign = $asy->getSign($str, $pk) . PHP_EOL;

echo '验证结果：' . $asy->verify($str, $sign, $gk);

echo "<hr>";

//私钥加密，公钥解密
echo "待加密数据：testInfo","<br />";
$pre = $asy->privEncrypt("testInfo",$pk);
echo "加密后的密文:<br />" . $pre . "<br />";
$pud = $asy->pubDecrypt($pre,$gk);
echo "解密后数据:" . $pud . "<br />";
echo "<hr>";
