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
        $userId = $this->getUserId();

        $collectionId = (int)$this->request->get('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }

//        $ind = (int)$this->request->get('ind');
        $lan = (int)$this->request->get('lan', 1);

        $data['state'] = 'OK';
        $data['data'] = Collection::queryByCollectionId($collectionId, $lan);

        $data['data']['is_collected'] = \app\api\model\MemberCollection::isCollection($userId, $collectionId);


//        $contract = $data['data']['contract'];
//
//        if ($ind == 1) {
//            $data['price_3d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 days')), $contract, 3);
//        } elseif ($ind == 2) {
//            $data['price_30d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-30 days')), $contract, 30);
//        } elseif ($ind == 3) {
//            $data['price_3m'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 months')), $contract, 90);
//        }

        $data['holder_stat'] = [
            '1' => StatHolderCt::countHolderByCt($collectionId, 1),
            '2-3' => StatHolderCt::countHolderByCt($collectionId, [2, 3]),
            '4-10' => StatHolderCt::countHolderByCt($collectionId, [4, 10]),
            '11-50' => StatHolderCt::countHolderByCt($collectionId, [11, 50]),
            '50-100' => StatHolderCt::countHolderByCt($collectionId, [50, 100]),
            '>100' => StatHolderCt::countHolderByCt($collectionId, [101, 0]),
        ];
        return json($data);
    }


    public function nft(): Json
    {
        $collectionId = (int)$this->request->post('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }
        $filterInd = (int)$this->request->post('filterInd', 1);
        $orderBy = (int)$this->request->post('orderBy', 1);
        $count = (int)$this->request->post('count', 20);
        $page = (int)$this->request->post('page', 1);

        $data = \app\api\model\Nft::getListByApi($this->getUserId(), $collectionId, $filterInd, $orderBy, $page, $count);
        return json(['status' => 'OK', 'data' => $data]);
    }

    public function search(): Json
    {
        $lan = (int)$this->request->post('lan',1); // 1:繁體中文 2:簡體中文 3:英文 4:日 5:韓
        // 項目錢包地址
//        $contract = $this->request->post('contract');
//        if (empty($contract)) {
//            return json(['code' => 400, 'message' => '項目錢包地址不能为空']);
//        }
        // 項目名稱關鍵字
        $keyword = $this->request->param('keyword');
        if (empty($keyword)) {
            return json(['code' => 400, 'message' => '項目名稱關鍵字不能为空']);
        }

        $field = 'id,name,photo_url,contract';

        $data['state'] = 'OK';
        $data['data'] = Collection::queryByKeyword($keyword, $field);

        return json($data);
    }

    public function priceHistory(): Json
    {
        $ind = (int)$this->request->param('ind');
        $lan = (int)$this->request->param('lan',1); // 1:繁體中文 2:簡體中文 3:英文 4:日 5:韓
        $userId = $this->getUserId();

        $collectionId = (int)$this->request->param('collectionId');
        if ($collectionId <= 0) {
            return json(['code' => 400, 'message' => '项目id不能为空']);
        }

        $data['state'] = 'OK';

        $collection = Collection::queryByCollectionId($collectionId, $lan);
        $contract = $collection['contract'];

        if ($ind == 1) {
            $data['price_3d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 days')), $contract, 3);
        } elseif ($ind == 2) {
            $data['price_30d'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-30 days')), $contract, 30);
        } elseif ($ind == 3) {
            $data['price_3m'] = StatCollectionDay::getPriceByDate(date('Y-m-d H:i:s', strtotime('-3 months')), $contract, 90);
        }

        return json($data);
    }
}