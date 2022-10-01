<?php


namespace app\api\model;


use think\Model;

class Nft extends Model
{
    protected $name = 'nft';

    public static function getInfoByIds($ids): array
    {
        if (empty($ids)) return [];

        return self::where('id', 'in', $ids)->select()->column('*', 'id');
    }
}