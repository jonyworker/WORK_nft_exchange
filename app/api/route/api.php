<?php
use think\facade\Route;

//Route::get("newslist","News/newslist");
Route::get(':controller/:method',':controller/:method');
Route::get(':controller',':controller/index');