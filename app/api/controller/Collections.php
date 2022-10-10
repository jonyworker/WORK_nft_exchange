<?php


namespace app\api\controller;

use app\api\model\Collection;
use app\api\model\StatCollectionDay;
use app\api\model\StatHolderCt;
use app\BaseController;
use think\App;
use think\db\exception\DbException;
use think\response\Json;

class Collections extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * @throws DbException
     */
    public function index(): Json
    {
        $collectionId = (int)$this->request->get('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }
        $lan = (int)$this->request->get('lan', 1);

        $data['state'] = 'OK';
        $data['data'] = Collection::queryByCollectionId($collectionId, $lan);

        $contract = $data['data']['contract'];

        $data['price_3d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 days')),$contract,3);
        $data['price_30d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-30 days')), $contract,30);
        $data['price_3m'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 months')), $contract,90);

        $data['holder_stat'] = [
            '1' => StatHolderCt::countHolderByCt($collectionId, 1),
            '2-3' => StatHolderCt::countHolderByCt($collectionId, [2,3]),
            '4-10' => StatHolderCt::countHolderByCt($collectionId, [4,10]),
            '11-50' => StatHolderCt::countHolderByCt($collectionId, [11,50]),
            '50-100' => StatHolderCt::countHolderByCt($collectionId, [50,100]),
            '>100' => StatHolderCt::countHolderByCt($collectionId, [101, 0]),
        ];
        return json($data);
    }


    public function ntf() :Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }
        $filterInd = (int)$this->request->get('filterInd', 1);
        $orderBy = (int)$this->request->get('orderBy', 1);
        $count = (int)$this->request->get('count', 20);
        $page = (int)$this->request->get('page', 1);

        $data = \app\api\model\Nft::getListByApi($collectionId, $filterInd, $orderBy, $page, $count);
        return json(['status' => 'OK', 'data' => $data]);
    }
}