<?php


namespace app\api\model;


use think\exception\HttpException;
use think\Model;

class MemberCollection extends Model
{
    public static function getListByApi($userId)
    {
        $list = self::where('member_id', $userId)->order('id', 'asc')->limit(500)->select();
        $collectionArr = Collection::getInfoByIds($list->column('collection_id'));
        $data = [];
        foreach ($list as $item) {
            $info = $collectionArr[$item->collection_id] ?? [];
            if(empty($info)) continue;

            $data[] = [
                'id' => $item->collection_id,
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
                'holders_p' => $info['holders_p'],
                'floor_price' => $info['floor_price'],
                'floor_price_p' => $info['floor_price_p'],
                'unit' => $info['unit'],
            ];
        }
        return $data;
    }

    public static function addMy($userId, $collectionId): bool
    {
        $info = self::findByCollectionId($userId, $collectionId);

        if($info) {
            return true;
        }
        return self::newRecords($userId, $collectionId);
    }

    public static function removeMy($userId, $collectionId): bool
    {
        $info = self::findByCollectionId($userId, $collectionId);

        if(empty($info)) {
            throw new HttpException(400, '项目记录不存在');
        }

        return $info->delete();
    }


    public static function findByCollectionId($userId, $collectionId)
    {
        return self::where('member_id', $userId)->where('collection_id', $collectionId)->find();
    }

    public static function newRecords($userId, $collectionId): bool
    {
        $info = new self;
        return $info->save([
            'member_id' => $userId,
            'collection_id' => $collectionId,
        ]);
    }

}