<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/2-0:20
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class Revert extends BaseValidate
{
    // 受保护的变量
    protected $rule = [
        'did' => 'require|number', // id
        'content' => 'require'
    ];

    // 受保护的变量
    protected $message = [
        'did' => '用户id',
        'content' => '内容不能为空'
    ];
}