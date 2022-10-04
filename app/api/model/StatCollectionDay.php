<?php


namespace app\api\model;


use think\Model;

class StatCollectionDay extends Model
{
    protected $name = 'stat_collection_day';


    public static function getPriceByDate($date, $limit)
    {
        $list = self::where('date', '>=', $date)->order('date', 'desc')->limit($limit)->select();
        $data = [];
        foreach ($list as $item) {
            $data[] = [
                'date' => $item['date'],
                'floor_price' => $item['floor_price'],
                'avg_price' => $item['avg_price'],
                'volume' => $item['volume'],
            ];
        }
        return $data;
    }
}