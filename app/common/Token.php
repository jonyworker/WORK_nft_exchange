<?php


namespace app\common;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    //生成token
    //id为用户ID
    public static function createToken($id,$key='api'){
        $jwt = new \Firebase\JWT\JWT();
        $key = "api";
        $payload = array(
            "iss" => "http://shuiwu.cn",
            "aud" => "http://shuiwu.cn",
            "iat" => time(),//收发时间
            "nbf" => time(),//生效时间
            'exp' => time() + 60 * 60 * 24,//过期时间24小时
            "aid" => $id//token中加入用户的ID
        );
        //生成token
        $token = $jwt::encode($payload, $key,'HS256');
        return $token;
    }

    //获取并验证token
    public static function getToken($token){
        $jwt = new JWT();
        try {
            $info = $jwt::decode($token,new Key('api', 'HS256'));
            if (empty($info->aid)){
                return error('token验证失败,用户不存在！！！');

            }
            return $info;
        }catch (\Firebase\JWT\ExpiredException $e){
            return error('token过期');
        }catch (\Firebase\JWT\SignatureInvalidException $e){
            return error('签名认证失败');
        }
    }
}