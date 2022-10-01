<?php

namespace app\api\middleware;

use app\api\model\Member;
use app\Request;
use think\exception\HttpException;

class Auth
{
    /**
     */
    public function handle(Request $request, \Closure $next)
    {
        //登录验证，未登录跳转至登录界面
        $token = $request->header('authorization');
        if(empty($token)) {
            throw new HttpException(401, '需要登录授权');
        }

        $info = Member::findByToken($token);
        if(!$info) {
            throw new HttpException(401, '请重新登录');
        }

       $request->withMiddleware(['userId' => $info['id']]);

        return $next($request);
    }
}