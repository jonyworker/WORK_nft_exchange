<?php


namespace app\api\controller;

use app\BaseController;
use think\App;
use think\response\Json;
use app\api\model\MemberNft as Nft;

class MemberNFT extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function index() : Json
    {
        $data['status'] = 'OK';
        $data['data'] = Nft::getListByApi($this->getUserId());

        return json($data);
    }

    public function add(): Json
    {
        $nftId = (int)$this->request->post('nftId');
        if($nftId <= 0) {
            return json(['code' => 400, 'message' => 'nftId不能为空']);
        }
        try{
            Nft::addMy($this->getUserId(), $nftId);
            return json(['status' => 'OK']);

        }catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }

    }

    public function remove(): Json
    {
        $nftId = (int)$this->request->post('nftId');
        if($nftId <= 0) {
            return json(['code' => 400, 'message' => 'nftId不能为空']);
        }

        try{
            Nft::removeMy($this->getUserId(), $nftId);
            return json(['status' => 'OK']);
        }catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }

    }
}