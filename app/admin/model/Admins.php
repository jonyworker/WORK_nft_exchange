<?php


namespace app\admin\model;


use app\common\model\TimeModel;
use think\Model;

class Admins extends Model
{

    public function getAuthList(): array
    {
        return (new AdminAuth())
            ->where('status', 1)
            ->column('title', 'id');
    }


}