<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/7-12:25
 * Email: <470193837@qq.com>
 */


namespace app\validate;



class Leave extends BaseValidate
{

    // 受保护的变量
    protected $rule = [
        'username' => 'require|length:1,25',
        'content' => 'require',
    ];


    // 受保护的变量
    protected $message = [
        'username' => '用户昵称，不能为空',
        'username.length' => '用户昵称，在1~30个字节',
        'content' => '内容描述，不能为空'
    ];

}