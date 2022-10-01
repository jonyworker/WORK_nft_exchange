<?php

use app\api\middleware\Auth;
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
Route::get('collection/index','Collections/index');