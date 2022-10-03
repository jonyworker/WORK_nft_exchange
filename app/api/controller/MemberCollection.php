<?php


namespace app\api\controller;

use app\BaseController;
use think\App;
use think\exception\HttpException;
use think\response\Json;
use app\api\model\MemberCollection as Collection;

class MemberCollection extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function index() : Json
    {
        $data['status'] = 'OK';
        $data['data'] = Collection::getListByApi($this->getUserId());

        return json($data);
    }

    public function add(): Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }
        try{
            Collection::addMy($this->getUserId(), $collectionId);
            return json(['status' => 'OK']);

        }catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }

    }

    public function remove(): Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }

        try{
            Collection::removeMy($this->getUserId(), $collectionId);
            return json(['status' => 'OK']);
        }catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }

    }
}