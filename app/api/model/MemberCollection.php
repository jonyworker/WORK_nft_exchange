<?php


namespace app\api\model;


use think\exception\HttpException;
use think\Model;

class MemberCollection extends Model
{
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