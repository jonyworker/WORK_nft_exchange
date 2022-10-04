<?php


namespace app\api\model;


use think\facade\Db;
use think\db\exception\DbException;
use think\Model;

class StatHolderCt extends Model
{
    protected $name = 'stat_holder_ct';


    /**
     * @throws DbException
     */
    public static function countHolderByCt($collectionId, $ct): int
    {
        $where[] = ['collection_id', '=', $collectionId];
        if(is_numeric($ct)) {
            $where[] = ['ct', '=', $ct];
        }

        if(is_array($ct)) {
            [$min, $max] = $ct;
            $where[] = ['ct', '>=', $min];
            if($max) {
                $where[] = ['ct', '<=', $max];
            }
        }

        return Db::table('stat_holder_ct')->where($where)->count();
    }
}