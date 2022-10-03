<?php


namespace app\api\controller;

use app\api\model\Collection;
use app\BaseController;
use think\App;
use think\exception\HttpException;
use think\response\Json;

class Collections extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function index(): Json
    {
        $collectionId = (int)$this->request->get('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }
        $lan = (int)$this->request->get('lan', 1);

        $data['state'] = 'OK';
        $data['data'] = Collection::queryByCollectionId($collectionId, $lan);
        return json($data);
    }
}