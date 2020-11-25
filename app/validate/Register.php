<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/25-23:49
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class Register extends BaseValidate
{
    protected $rule = [
        'usermail' => 'require|email',
        'password' => 'require|min:6|max:16',
        'username' => 'require|min:2|max:10'
    ];


    protected $message = [
        'usermail' => '邮箱不能为空',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不能小于6位',
        'password.max' => '密码长度不能大于16位',
        'username.require' => '用户名不能为空',
        'username.min' => '用户名不能小于2位',
        'username.max' => '用户名不能大于10位'
    ];
}