<?php

//登录
namespace app\admin\controller;


use app\admin\model\Admins as AdminsModel;
use app\BaseController;
use app\common\Token;
use think\Exception;
use think\facade\View;
use app\admin\validate\LoginValidate;
class Login extends BaseController
{
    public function index()
    {
        if ($this->request->isPost()){
            $data = input('post.');
            $validate = new LoginValidate();
            if (!$validate->check($data)){
                return error($validate->getError());
            }
            try {
                $model = new AdminsModel();
                $result = $model->getUsername($data);
                //生成token
//                $token = Token::createToken($result['user_id']);
            }catch (Exception $e){
                return error($e->getMessage());
            }
            if (!$result){
                return error('登录失败');
            }
            return success($result,'登录成功');
        }
        return View::fetch();
    }
}