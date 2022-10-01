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
        $token = $request->header('access-token');

        if(empty($token)) {
            return json(['code' => 401, 'message' => '需要登陸授權']);
//            throw new HttpException(401, '需要登录授权');
        }

        $info = Member::findByToken($token);
        if(empty($info)) {
            return json(['code' => 401, 'message' => 'Token已過期，請重新登陸']);
//            throw new HttpException(401, '请重新登录');
        }

       $request->withMiddleware(['userId' => $info['id']]);

        return $next($request);
    }
}