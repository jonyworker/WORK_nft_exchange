<?php


namespace app\api\controller;

use app\api\model\Collection;
use app\BaseController;
use think\App;
use think\exception\HttpException;

class Collections extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        $collectionId = (int)$this->request->get('collectionId');
        if($collectionId <= 0) {
            throw new HttpException(400, '项目id不能为空');
        }
        $lan = (int)$this->request->get('lan', 1);

        $data['state'] = 'OK';
        $data['data'] = Collection::queryByCollectionId($collectionId, $lan);
        return json($data);
    }
}