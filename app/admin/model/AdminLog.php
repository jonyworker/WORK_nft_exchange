<?php

namespace app\admin\model;


use think\Model;

class AdminLog extends Model
{

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->name = 'system_log_' . date('Ym');
    }

    public function setMonth($month)
    {
        $this->name = 'system_log_' . $month;
        return $this;
    }

    public function admin()
    {
        return $this->belongsTo('app\admin\model\SystemAdmin', 'admin_id', 'id');
    }


}