<?php


namespace app\api\model;


use think\Model;

class Member extends Model
{

    public static function findByToken($token) :? self
    {
        $info = self::where('token', '=', $token)->find();

        if(empty($info)) {
            return null;
        }

        return $info;
    }

}