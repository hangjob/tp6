<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/30-23:29
 * Email: <470193837@qq.com>
 */


namespace app\validate;


class DiscussAdd extends BaseValidate
{
    // 受保护的变量
    protected $rule = [
        'fid' => 'require|number', // id
        'type' => 'require|number', // 类型
        'content' => 'require'
    ];

    // 受保护的变量
    protected $message = [
        'fid' => '文章id不能为空',
        'type' => '上传类型，0 文章 1 网址 2 视屏 3 社区 4 投票  5工具 6源码',
        'content' => '内容不能为空'
    ];

}