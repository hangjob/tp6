<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-20:07
 * Email: <470193837@qq.com>
 */

use think\facade\Route;

$urlPrefix = '';

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
    Route::rule('detail','detail');
    Route::rule('addlike','addlike');
    Route::rule('items','items');
    Route::rule('ditems','ditems');
    Route::rule('popularIt','popularIt');
    Route::rule('daily','daily');
    Route::rule('category','category');
    Route::rule('search','search');
    Route::rule('append','append');
})->ext($urlPrefix)->prefix('navtag/');

Route::group('taxonomic',function (){
    Route::rule('items','items');
    Route::rule('youlike','youlike');
    Route::rule('types','types');
})->ext($urlPrefix)->prefix('taxonomic/');

Route::group('primary',function (){
    Route::rule('types','types');
})->ext($urlPrefix)->prefix('primary/');


Route::group('discuss',function (){
    Route::rule('items','items');
    Route::rule('add','add');
    Route::rule('addRevert','addRevert');
})->ext($urlPrefix)->prefix('discuss/');

Route::group('wxcontent',function (){
    Route::rule('items','items');
    Route::rule('detail/:id','detail');
    Route::rule('groups','groups');
})->ext($urlPrefix)->prefix('wxcontent/');

Route::group('wxarticle',function (){
    Route::rule('correlation','correlation');
})->ext($urlPrefix)->prefix('wxarticle/');


Route::group('taobao',function (){
    Route::rule('items','items');
})->ext($urlPrefix)->prefix('taobao/');


Route::group('figure',function (){
    Route::rule('items','items');
    Route::rule('bans','bans');
})->ext($urlPrefix)->prefix('figure/');

Route::group('configuration',function (){
    Route::rule('navcount','navcount');
})->ext($urlPrefix)->prefix('configuration/');

Route::group('navtheme',function (){
    Route::rule('items','items');
    Route::rule('detail','detail');
    Route::rule('newest','newest');
})->ext($urlPrefix)->prefix('navtheme/');

Route::group('appdownload',function (){
    Route::rule('items','items');
    Route::rule('ranking','ranking');
})->ext($urlPrefix)->prefix('appdownload/');


