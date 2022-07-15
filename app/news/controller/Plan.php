<?php

//企劃管理
namespace app\news\controller;


use app\BaseController;
use app\news\model\News as NewsModel;
use think\App;
use think\facade\Db;

class Plan extends BaseController
{


    //首頁
    public function index()
    {
        $model = new NewsModel();
        $list = $model->limit(20)->select();
        return success($list);
    }

}