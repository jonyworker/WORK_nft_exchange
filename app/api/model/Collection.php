<?php


namespace app\api\model;


use think\Model;

class Collection extends Model
{

    public static function queryByCollectionId($collectionId, $lan): array
    {
        $fieldLan = config('api.language')[$lan] ?? '';
        $info = self::findById($collectionId);
        return [
            'id' => $info['id'],
            'name' => $info['name'],
            'photo_url' => $info['photo_url'],
            'contract' => $info['contract'],
            'item_qty' => $info['item_qty'],
            'market_cap' => $info['market_cap'],
            'market_cap_p' => $info['market_cap_p'],
            'volume_24' => $info['volume_24'],
            'volume_24_p' => $info['volume_24_p'],
            'sales_24' => $info['sales_24'],
            'holders' => $info['holders'],
            'website' => $info['website'],

            'twitter' => $info['twitter'],
            'discord' => $info['discord'],
            'instagram' => $info['instagram'],
            'category' => $info['category'],
            'floor_price' => $info['floor_price'],

            'introduction' => $info['introduction' . $fieldLan],
            'member' => $info['member' . $fieldLan],
            'roadmap' => $info['roadmap' . $fieldLan],
        ];
    }


    public static function findById($id)
    {
        return self::where('id', '=', $id)->find();
    }

    public static function getInfoByIds($ids): array
    {
        if (empty($ids)) return [];
        return self::whereIn('id', implode(',', $ids))->select()->column('*', 'id');
    }
}