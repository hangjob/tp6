<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/30-21:47
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class AddNavtag extends BaseValidate
{

    // 受保护的变量
    protected $rule = [
        'it_name' => 'require|unique:navtag',
        'url' => 'require|unique:navtag',
    ];


    // 受保护的变量
    protected $message = [
        'it_name.unique' => '网址名称已存在啦，勿重复收录',
        'url.unique' => '网址地址已存在啦，勿重复收录'
    ];

}