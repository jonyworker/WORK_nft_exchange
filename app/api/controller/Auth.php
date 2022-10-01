<?php

namespace app\api\controller;

use app\BaseController;
use think\App;
use think\response\Json;
use app\api\model\Member;

class Auth extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function login()
    {

    }


    public function logout(): Json
    {
        try {
            Member::clearToken($this->getUserId());
            return json(['status' => 'OK']);
        }catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }
    }

}