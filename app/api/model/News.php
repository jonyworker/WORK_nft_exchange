<?php


namespace app\api\model;


use think\Model;

class News extends Model
{
    public function getNews($data, $keyword)
    {
        $keyword = trim($keyword);

        $list = $this->where([
            ['valid', '=', 1],
            ['ind', '=', $data['ind']],
            ['title', 'like', '%' . $keyword . '%']
        ])
            ->whereOr('sub_title', 'like', '%' . $keyword . '%')
            ->whereOr('content', 'like', '%' . $keyword . '%')
            ->page($data['page'])
            ->order('start_date DESC')
            ->paginate($data['count']);
        return $list;
    }
}