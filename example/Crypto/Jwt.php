<?php
    require_once('../../vendor/autoload.php');

    use Dongyao8\Commuse\Crypto\Jwt;

    $key = '123123123123'; //生成token所需秘钥

    $jwt = new Jwt($key);

    /**
     * 获取jwt token
     * @param array $payload jwt载荷  格式如下非必须
     *                       [
     *                       'iss'=>'jwt_admin', //该JWT的签发者
     *                       'iat'=>time(), //签发时间
     *                       'exp'=>time()+7200, //过期时间
     *                       'nbf'=>time()+60, //该时间之前不接收处理该Token
     *                       'sub'=>'www.admin.com', //面向的用户
     *                       'jti'=>md5(uniqid('JWT').time()) //该Token唯一标识
     *                       ]
     * @return bool|string
     */
    $payload = ['uid'=>123];
    echo "token结果：".$token = $jwt->getToken($payload);
    echo "<hr>";
    echo "验证结果:".json_encode($jwt->verifyToken($token));

