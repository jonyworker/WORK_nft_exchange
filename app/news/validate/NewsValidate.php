<?php


namespace app\news\validate;


use think\Validate;

class NewsValidate extends Validate
{
    protected $rule = [
        'title|主標' => 'require',
        'content|内文' => 'require',
        'start_date|上架日' => 'require',
        'valid|狀態' => 'require'
    ];
}