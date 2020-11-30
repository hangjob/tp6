<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/30-0:30
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class Discuss extends BaseValidate
{

    // 受保护的变量
    protected $rule = [
        'fid' => 'require|number', // id
        'type' => 'require|number', // 类型
    ];

    // 受保护的变量
    protected $message = [
        'fid' => '文章id不能为空',
        'type' => '0 文章 1 网址 2 视屏 3 社区 4 投票  5工具 6源码',
    ];

}