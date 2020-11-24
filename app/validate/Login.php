<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/24-22:50
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class Login extends BaseValidate
{
    protected $rule = [
        'usermail' => 'require|email',
        'password' => 'require|min:6|max:16'
    ];

    // 受保护的变量
    protected $message = [
        'usermail' => '邮箱不能为空',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不能小于6位',
        'password.max' => '密码长度不能大于16位'
    ];

}