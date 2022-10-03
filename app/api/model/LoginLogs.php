<?php


namespace app\api\model;


use think\Model;

class LoginLogs extends Model
{
    protected $name = 'login_log';

    public static function createdLogs($type, $username, $ip, $appCodeName)
    {
        return self::create([
            'ind' =>1,
            'username' =>$username,
            'type' => $type,
            'ip' => $ip,
            'appCodeName' => $appCodeName
        ]);

        
    }
}