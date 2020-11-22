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