<?php

use app\api\middleware\Auth;
use think\facade\Route;

//將項目從追蹤清單移除 Method:POST URL： api/member/collection/remove
Route::post('member/collection/remove','MemberCollection/remove')->middleware(Auth::class);
//將項目加入追蹤清單 Method:POST URL： api/member/collection/add
Route::post('member/collection/add','MemberCollection/add')->middleware(Auth::class);
//取得會員追蹤項目清單 Method:POST URL：api/member/collection/index
Route::post('member/collection/index','MemberCollection/index')->middleware(Auth::class);

//取得項目主頁資訊 GET api/collection/index
Route::get('collection/index','Collections/index');