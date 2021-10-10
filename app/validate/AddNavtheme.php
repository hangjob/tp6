<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/14-11:57
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class AddNavtheme extends BaseValidate
{
    // 受保护的变量
    protected $rule = [
        'title' => 'require',
        'describe' => 'require',
    ];


    // 受保护的变量
    protected $message = [
        'title.require' => '标题不能为空',
        'describe.require' => '内容描述不能为空'
    ];

}