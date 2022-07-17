<?php


namespace app\admin\model;


use think\Model;

class Admins extends Model
{
    public function getUsername($data)
    {
        $user = self::where('username',$data['username'])->find();
        $user['password'] = 'e10adc3949ba59abbe56e057f20f883e';

        if (empty($user) || $user['password'] != md5($data['password'])){
            return false;
        }
        session('id',$user['id']);
        session('username',$user['username']);
        return $user;
    }
}