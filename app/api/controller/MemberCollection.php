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

    public function add(): Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if($collectionId <= 0) {
            throw new HttpException(400, '项目id不能为空');
        }
        Collection::addMy($this->getUserId(), $collectionId);

        return json(['status' => 'OK']);
    }

    public function remove(): Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if($collectionId <= 0) {
            throw new HttpException(400, '项目id不能为空');
        }
        Collection::removeMy($this->getUserId(), $collectionId);

        return json(['status' => 'OK']);
    }
}