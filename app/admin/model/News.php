<?php


namespace app\admin\model;

use think\Model;

class News extends Model
{

    const Types = [
        'news' => 1,
        'specials' => 2,
        'plannings' => 3,
    ];

}