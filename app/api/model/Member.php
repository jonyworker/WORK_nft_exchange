<?php


namespace app\api\model;


use think\Model;

class Member extends Model
{

    public static function findByToken($token) :? self
    {
        return self::where('token', '=', $token)->find();
    }

}