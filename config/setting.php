<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-13:33
 * Email: <470193837@qq.com>
 */

function get_http_type()
{
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    return $http_type;
}

function url_prefix(){
    $app_debug = config("app_debug");
    if($app_debug){
        return get_http_type() . $_SERVER['HTTP_HOST'];
    }else{
        return get_http_type() . 'www.vipbic.com';
    }
}
return [
    //图片前缀
    'url_prefix' => url_prefix()
];