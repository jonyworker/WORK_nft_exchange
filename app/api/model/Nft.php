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
}