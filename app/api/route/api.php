<?php

use app\api\middleware\Auth;
use think\facade\Route;

//Route::get("newslist","News/newslist");
//Route::get(':controller/:method',':controller/:method');
//Route::get(':controller',':controller/index');
//Route::get('member/index','Member/index')->middleware(Auth::class);

//將項目從追蹤清單移除 Method:POST URL： api/member/collection/remove
Route::post('member/collection/remove','MemberCollection/remove')->middleware(Auth::class);
//將項目加入追蹤清單 Method:POST URL： api/member/collection/add
Route::post('member/collection/add','MemberCollection/add')->middleware(Auth::class);
//取得會員追蹤項目清單 Method:GET URL：api/member/collection/index
Route::get('member/collection/index','MemberCollection/index')->middleware(Auth::class);

//取得項目主頁資訊 api/collection/index
Route::get('collection/index','Collections/index');