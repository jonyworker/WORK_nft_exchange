<?php

use app\api\middleware\Auth;
use app\api\middleware\OptionalAuth;
use think\facade\Route;

//会员登录 Method:POST URL： api/login
Route::post('login','Auth/login');
//会员登录 Method:POST URL： api/logout
Route::post('logout','Auth/logout')->middleware(Auth::class);

//將項目從追蹤清單移除 Method:POST URL： api/member/collection/remove
Route::post('member/collection/remove','MemberCollection/remove')->middleware(Auth::class);
//將項目加入追蹤清單 Method:POST URL： api/member/collection/add
Route::post('member/collection/add','MemberCollection/add')->middleware(Auth::class);
//取得會員追蹤項目清單 Method:GET URL：api/member/collection/index
Route::get('member/collection/index','MemberCollection/index')->middleware(Auth::class);

//16. 取得會員追蹤NFT清單 Method:GET URL：api/member/nft/index
Route::get('member/nft/index','MemberNFT/index')->middleware(Auth::class);
//18.將項目從追蹤清單移除 Method:POST URL： api/member/nft/remove
Route::post('member/nft/remove','MemberNFT/remove')->middleware(Auth::class);
//17.將項目加入追蹤清單 Method:POST URL： api/member/nft/add
Route::post('member/nft/add','MemberNFT/add')->middleware(Auth::class);

//取得項目主頁資訊 GET api/collection/index
Route::get('collection/index','Collections/index')->middleware(OptionalAuth::class);
//取得項目主頁NFT卡片 POST api/collection/nft
Route::post('collection/nft','Collections/nft')->middleware(OptionalAuth::class);

//图片上传 POST /api/upload/image 字段file
Route::post('upload/image','Upload/image')->middleware(Auth::class);

//20. 更新用戶基本資料 POST /api/member/profile/update
Route::post('member/profile/update','Users/updatedProfile')->middleware(Auth::class);
//21. 取得會員基本資料 GET /api/member/profile/index
Route::get('member/profile/index','Users/profile')->middleware(Auth::class);