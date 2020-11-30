<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-20:07
 * Email: <470193837@qq.com>
 */

use think\facade\Route;

$urlPrefix = 'html';

// 使用前缀 prefix
// 添加额外参数 append
Route::group('blog', function () {
    Route::rule('/', 'index');
    Route::rule('index', 'index');
    Route::rule('home', 'home');
    Route::rule('abnormal', 'abnormal');
    Route::rule('detail/:id', 'detail');
})->ext($urlPrefix)->prefix('blog/')->append(['status'=>1]);


Route::group('login',function (){
    Route::rule('/','login');
    Route::rule('userinfo','userinfo');
    Route::rule('register','register');
})->ext($urlPrefix)->prefix('login/');


Route::group('navtag',function (){
    Route::rule('detail/:id','detail');
})->ext($urlPrefix)->prefix('navtag/');


Route::group('discuss',function (){
    Route::rule('items','items');
    Route::rule('add','add');
})->ext($urlPrefix)->prefix('discuss/');