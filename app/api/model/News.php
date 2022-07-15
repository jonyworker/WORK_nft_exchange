<?php


namespace app\api\model;


use think\Model;

class News extends Model
{
    public function getNews($data,$keyword)
    {
        $keyword = trim($keyword);
        $where = [
            ['valid','=',1],
            ['ind','=',$data['ind']]
        ];

        $list = $this->where([$where])
            ->whereOr('title|sub_title|content','like','%'.$keyword.'%')
            ->page($data['page'])
            ->order('start_date DESC')
            ->paginate($data['count']);
        return $list;
    }
}