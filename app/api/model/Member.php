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

    public static function findByAddress($address)
    {
        return self::where('username', $address)->find();
    }

    public static function createdNewAddress($address, $isHolder, $assets): array
    {
        $token = self::generateToken($address);
        $data = [
            'username' => $address,
            'is_holder' => $isHolder,
            'token' => $token,
            'verify_time' => date('Y-m-d H:i:s'),
            'verify_times' => 1
        ];
        if($assets) {
            $data['asset'] = json_encode($assets, JSON_UNESCAPED_UNICODE);
        }
        self::create($data);
        return [$token, true];
    }

    public static function updatedToken($member, $address, $isHolder, $assets): array
    {
        $needLogs = false;

        $token = self::generateToken($address);
        $member->is_holder = $isHolder;
        $member->token = $token;
        if($assets) {
            $member->asset = json_encode($assets, JSON_UNESCAPED_UNICODE);
        }

        if(time() - strtotime($member['verify_time']) >= 3600) {
            $member->verify_times += 1;
            $needLogs = true;
        }
        $member->verify_time  = date('Y-m-d H:i:s');
        $member->save();

        return [$token, $needLogs];
    }

    public static function generateToken($address)
    {
        return  sha1($address . time());
    }

    /**
     * @param $userId
     * @return bool
     * @throws Exception
     */
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


    public static function modifyProfile($userId, $name, $email, $img)
    {
        $info = self::findByUserId($userId);

        if(empty($info)) {
            throw new Exception('會員信息不存在');
        }

        $info['name'] = $name;
        $info['email'] = $email;
        $info['photo_url'] = $img;
        $info->save();
        return true;
    }



}