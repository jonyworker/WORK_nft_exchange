<?php


namespace app\admin\validate;


use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'username|账号' => 'require',
        'password|密码' => 'require'
    ];
}