<?php


namespace app\api\model;


use think\exception\HttpException;
use think\Model;

class MemberNft extends Model
{
    protected $name = 'member_nft';

    public static function getListByApi($userId)
    {
        $list = self::where('member_id', $userId)->order('id', 'asc')->limit(500)->select();
        $nftArr = Nft::getInfoByIds($list->column('nft_id'));
        $data = [];
        foreach ($list as $item) {
            $info = $nftArr[$item->nft_id] ?? [];
            if(empty($info)) continue;

            $data[] = [
                'id' => $item->nft_id,
                'collection_name' => $info['name'],
                'photo_url' => $info['photo_url'],
                'contract' => $info['contract'],
                'token_id' => $info['contract'],
            ];
        }
        return $data;
    }


    public static function addMy($userId, $nftId): bool
    {
        $info = self::findByNftId($userId, $nftId);
        if($info) {
            return true;
        }
        return self::newRecords($userId, $nftId);
    }

    public static function removeMy($userId, $nftId): bool
    {
        $info = self::findByNftId($userId, $nftId);
        if(empty($info)) {
            throw new HttpException(400, 'NFT记录不存在');
        }

        return $info->delete();
    }


    public static function findByNftId($userId, $nftId)
    {
        return self::where('member_id', $userId)->where('nft_id', $nftId)->find();
    }

    public static function newRecords($userId, $nftId): bool
    {
        $info = new self;
        return $info->save([
            'member_id' => $userId,
            'nft_id' => $nftId,
        ]);
    }


}