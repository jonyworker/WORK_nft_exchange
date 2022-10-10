<?php


namespace app\api\model;


use think\facade\Db;
use think\Model;

class Nft extends Model
{
    protected $name = 'nft';

    public static function getInfoByIds($ids): array
    {
        if (empty($ids)) return [];

        $list = self::where('id', 'in', $ids)->select()->toArray();

        $data=  [];
        foreach ($list as $item) {
            $data[$item['id']] = $item;
        }
        return $data;
    }

    public static function queryTID($address, $contract)
    {
        return self::where('contract', $contract)->where('holder', $address)->find();
    }

    public static function getListByApi($collectionId, $filterInd, $orderBy, $page = 1, $perPage = 20)
    {
        $contract = Collection::queryByCollectionId($collectionId, 1);
        $contract = $contract['contract'];
        $where[] = ['contract', '=', $contract];

        if($filterInd == 1) {
            $where[] = ['usd_price', '>', 0];
        }

        $order = $orderBy == 1 ? 'asc' : 'desc';

        $list = self::where($where)->order('price', $order)->page($page, $perPage)->select();

        if(empty($list) || $list->isEmpty()) {
            return [];
        }

        $data = [];
        foreach ($list as $item) {
            $data[] = [
                'id' => $item['id'],
                'photo_url' => $item['photo_url'],
                'price' => $item['price'],
                'unit' => $item['unit'],
                'usd_price' => $item['usd_price'],
                'permalink' => $item['permalink'],
            ];

        }
        return $data;
    }
}