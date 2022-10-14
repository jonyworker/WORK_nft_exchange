<?php


namespace app\api\controller;

use app\BaseController;
use think\App;
use think\response\Json;

class Users extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function profile() :? Json
    {
        $info = \app\api\model\Member::findByUserId($this->getUserId());
        $data['status'] = 'OK';
        $data['data'] = [
            'id' => $info['id'],
            'name' => $info['name'],
            'photo_url' => $info['photo_url'],
            'username' => $info['username'],
            'email' => $info['email'],
            'is_holder' => $info['is_holder']
        ];
        return json($data);
    }

    public function updatedProfile() :? Json
    {
        $name = trim($this->request->post('name', ''));
        $email = trim($this->request->post('email', ''));
        $img = trim($this->request->post('img', ''));

        if($name)  {
            return json(['status' => 'FAIL', 'message' => 'Name不能为空']);
        }

        if($email && validateEmail($email))  {
            return json(['status' => 'FAIL', 'message' => '邮箱格式错误']);
        }

        \app\api\model\Member::modifyProfile($this->getUserId(), $name, $email, $img);

        return json(['status' => 'OK']);
    }




}