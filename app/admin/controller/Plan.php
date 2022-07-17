<?php


namespace app\admin\controller;


use app\BaseController;
use think\Exception;
use think\facade\View;
use app\admin\model\News as NewsModel;
use app\admin\validate\PlanValidate;
use think\facade\Filesystem;
class Plan extends BaseController
{
    //首頁
    public function index()
    {
        return View::fetch();
    }


    public function planlst()
    {
        //搜索条件
        $data = [
            'count' => input('limit'),
            'page' => input('page')
        ];
        $search = [
            'title' => trim($this->request->param('title')),
            'sub_title' => trim($this->request->param('sub_title')),
            'content' => trim($this->request->param('content')),
            'valid' => $this->request->param('valid')
        ];
        $model = new NewsModel();
        $result = $model->getNewsPlan($search,$data);
        return success($result);
    }

    public function add()
    {
        if ($this->request->isPost()){
            $data = input('post.');
            $username = $this->request->session('username');
            $validate = new PlanValidate();
            if (!$validate->check($data)){
                return error($validate->getError());
            }
            try {
                $model = new NewsModel();
                $result = $model->savePlanData($data,$username);
            }catch (Exception $e){
                return error($e->getMessage());
            }
            if (!$result){
                return error("操作失败");
            }
            return success($data,'操作成功');
        }
        return View::fetch();
    }

    public function edit($id)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $model = new NewsModel();
        $plans = $model->field($field)->find($id);
//
//        if ($this->request->isPost()){
//            $data = input('post.');
//            $username = $this->request->session('username');
//            $validate = new PlanValidate();
//            if (!$validate->check($data)){
//                return error($validate->getError());
//            }
//            try {
//                $model = new NewsModel();
//                $result = $model->savePlanData($data,$username);
//            }catch (Exception $e){
//                return error($e->getMessage());
//            }
//            if (!$result){
//                return error("操作失败");
//            }
//            return success($data,'操作成功');
//        }

        View::assign('plan',$plans);
        return View::fetch();
    }

    //图片上传
    public function getImage(){

        $image = $this->request->file('file');
        //上传文件保存路径public/storage/topic目录下
        $savename = Filesystem::disk('public')->putFile( 'topic', $image);
        //获取图片路径
//        $path = str_replace('\\','/',public_path().'storage/'.$savename);
        $path = str_replace('\\','/',$savename);

        return success($path,"上传成功");
    }
}