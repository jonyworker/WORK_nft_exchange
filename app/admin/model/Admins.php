<?php


namespace app\admin\model;


use app\common\model\TimeModel;
use think\Model;

class Admins extends Model
{
    public static function findByUserName($userName, $password) :? Admins
    {
        $user = self::where('username',$userName)->find();

        if (empty($user) || $user['password'] != md5($password)){
            return null;
        }
        return $user;
    }
}