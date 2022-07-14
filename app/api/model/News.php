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

        $search = [
            ['title', 'like', '%'.$keyword.'%'],
            ['sub_title', 'like', '%'.$keyword.'%'],
            ['content', 'like', '%'.$keyword.'%'],
        ];
        $list = $this->where([$where])
            ->where('title|sub_title|content','like','%'.$keyword.'%')
            ->page($data['page'])
            ->order('start_date DESC')
            ->paginate($data['count']);
        return $list;
    }
}