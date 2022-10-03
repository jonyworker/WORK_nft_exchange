<?php


namespace app\api\model;


use think\Exception;
use think\Model;

class Member extends Model
{

    public static function findByToken($token) :? self
    {
        return self::where('token', '=', $token)->find();
    }

    public static function findByUserId($userId)
    {
        return self::where('id', $userId)->find();
    }


    public static function clearToken($userId): bool
    {
        $info = self::findByUserId($userId);

        if(empty($info)) {
            throw new Exception('會員信息不存在');
        }

        $info->token = NULL;
        $info->save();

        return true;
    }

}