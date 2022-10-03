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

//成功返回(自定义返回键值)
function success2($key = 'data',$data = [] , $status = "ok")
{
    $result = [
        'status' => $status,
        $key => $data
    ];
    return json($result);
}

//失败返回(自定义返回)
function error2($status = "error")
{
    $result = [
        'status' => $status
    ];
    return json($result);
}

//成功返回(自定义返回内容)
function success3($result = [])
{
    return json($result);
}


function getIP()
{
    return $_SERVER['REMOTE_ADDR'] ?? null;
}

