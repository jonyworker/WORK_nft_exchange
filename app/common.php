<?php
// 应用公共文件

//成功返回
function success($data = [] , $status = "OK")
{
    $result = [
        'status' => $status,
        'data' => $data
    ];
    return json($result);
}

//失败返回
function error($status = "")
{
    $result = [
        'status' => $status,
    ];
    return json($result);
}