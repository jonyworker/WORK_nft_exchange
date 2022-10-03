<?php


namespace app\api\model;


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
}