<?php

//企劃管理
namespace app\news\controller;


use app\BaseController;
use app\news\model\News as NewsModel;
use think\App;
use app\news\validate\PlanValidate;
use think\Exception;

class Plan extends BaseController
{
    //首頁
    public function index()
    {
        $model = new NewsModel();
        $list = $model->where('ind',3)->limit(20)->select();
        return success($list);
    }

    //添加與更新
    public function save()
    {
        if ($this->request->isPost()){
            return error("请求发送失败");
        }
        $id = $this->request->param('id');
        $username = $this->request->param('username');
        $data = [
            'title' => $this->request->param('title'),
            'sub_title' => $this->request->param('sub_title'),
            'content' => $this->request->param('content'),
            'start_date' => $this->request->param('start_date'),
            'small_photo_url' => $this->request->param('small_photo_url'),
            'source' => $this->request->param('source'),
            'valid' => $this->request->param('valid',1),
        ];

        $validate = new PlanValidate();
        if (!$validate->check($data)){
            return error($validate->getError());
        }

        try {
            $model = new NewsModel();
            $result = $model->savePlanData($data,$id,$username);
        }catch (Exception $e){
            return error($e->getMessage());
        }
        if (!$result){
            return error("操作失败");
        }
        return json(['status'=>'操作成功']);
    }


}