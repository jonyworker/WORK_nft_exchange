<?php

namespace app\api\middleware;

use app\api\model\Member;
use app\Request;
use think\exception\HttpException;

class OptionalAuth
{
    /**
     */
    public function handle(Request $request, \Closure $next)
    {
        //登录验证，未登录跳转至登录界面
        $token = $request->header('access-token');
        $userId = 0;
        if($token) {
            $info = Member::findByToken($token);
            if(empty($info)) {
                $userId =0;
            } else {
                $userId = $info['id'];

            }

        }

        $request->withMiddleware(['userId' => $userId]);
        return $next($request);
    }
}