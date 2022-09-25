<?php


namespace app\admin\controller;


use app\admin\model\Admins;
use app\admin\model\SystemQuick;
use app\common\controller\AdminController;
use think\facade\View;

class Index extends AdminController
{
    public function index()
    {
        return View::fetch();
    }


    /**
     * 后台欢迎页
     * @return string
     * @throws \Exception
     */
    public function welcome()
    {
        return $this->fetch();
    }
}