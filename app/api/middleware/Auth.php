<?php

namespace app\api\middleware;

use app\api\model\Member;
use think\Exception;
use app\Request;

class Auth
{
    /**
     * @throws Exception
     */
    public function handle(Request $request, \Closure $next)
    {
        //登录验证，未登录跳转至登录界面
        $token = $request->header('Authorization');
        if(empty($token)) {
            throw new Exception('需要登录授权', 401);
        }

        $info = Member::findByToken($token);
        if(!$info) {
            throw new Exception('请重新登录', 401);
        }

       $request->withMiddleware(['userId' => $info['id']]);

        return $next($request);
    }
}