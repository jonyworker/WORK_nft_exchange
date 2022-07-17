<?php
// 应用公共文件

//成功返回
function success($data = [] , $status = "OK" , $errorCode = 0)
{
    $result = [
        'status' => $status,
        'data' => $data,
        'errorCode' => $errorCode
    ];
    return json($result);
}

//失败返回
function error($status = "" , $errorCode = 1)
{
    $result = [
        'status' => $status,
        'errorCode' => $errorCode
    ];
    return json($result);
}