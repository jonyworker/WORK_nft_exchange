<?php

//企劃管理
namespace app\news\controller;


use app\BaseController;
use app\news\model\News as NewsModel;
use think\App;
use app\news\validate\PlanValidate;
use think\Exception;
use app\common\Excel;
use think\facade\Db;

class Plan extends BaseController
{
    //首頁
    public function index()
    {
        //搜索条件
        $search = [
            'title' => trim($this->request->param('title')),
            'sub_title' => trim($this->request->param('sub_title')),
            'content' => trim($this->request->param('content')),
            'valid' => $this->request->param('valid')
        ];
        $model = new NewsModel();
        $list = $model->getNewsPlan($search);
        return success($list);
    }

    //添加與更新
    public function save()
    {
        if ($this->request->isPost()){
            return error("请求发送失败");
        }
        $id = $this->request->param('id');
        $username = $this->request->param('username');//登录用户
        $data = [
            'title' => $this->request->param('title'),
            'sub_title' => $this->request->param('sub_title'),
            'content' => $this->request->param('content'),
            'start_date' => $this->request->param('start_date'),
            'smal_photo_url' => $this->request->param('smal_photo_url'),
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

    //导出excel表格
    public function export()
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $data = Db::name('news')->field($field)->where('ind',1)->select()->toArray();
        $excel = new Excel();
        return $excel->export($data);
    }
}