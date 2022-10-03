<?php

namespace app\api\controller;

use app\api\model\LoginLogs;
use app\BaseController;
use think\App;
use think\Exception;
use think\facade\Db;
use think\response\Json;
use app\api\model\Member;

class Auth extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function login()
    {
        $address = trim($this->request->post('address', ''));
        if (empty($address)) {
            return json(['code' => 400, 'message' => '錢包地址不能為空']);
        }
        $assets = $this->request->post('asset');
        $type = $this->request->post('type', 1);
        $appCodeName = $this->request->post('appCodeName', '');

        $db = new Db();
        try {
            $holdingAtlNft = [];
            if($assets && !empty($assets['contents'])) {
                $contents = $assets['contents'];
                foreach ($contents as $content) {
                    $nftInfo = \app\api\model\Nft::queryTID($address, $content['contract']);
                    if(empty($nftInfo)) continue;

                    $holdingAtlNft[] = $nftInfo['token'];
                }
            }

            $isHolder = empty($holdingAtlNft) ? 1 : 2;
            $db->startTrans();

            $member = Member::findByAddress($address);
            if (empty($member)) {
                [$token, $needLogs] = Member::createdNewAddress($address, $isHolder, $assets);
            } else {
                [$token, $needLogs] = Member::updatedToken($member, $address, $isHolder, $assets);
            }

            if($needLogs) {
                //登陸日誌
                LoginLogs::createdLogs($type, $address, getIP(), $appCodeName);
            }


            $db->commit();

            return json([
                'status' => 'OK',
                'token' => $token,
                'username' => $address,
                'is_holder' => $isHolder, //#1:非holder   2:是holder
                'holding_atl_nft' => empty($holdingAtlNft) ? '' : implode(',', $holdingAtlNft)
            ]);

        } catch (\Throwable $exception) {
            $db->rollback();
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }
    }


    public function logout(): Json
    {
        try {
            Member::clearToken($this->getUserId());
            return json(['status' => 'OK']);
        } catch (\Throwable $exception) {
            return json(['code' => 400, 'message' => $exception->getMessage()]);
        }
    }

}