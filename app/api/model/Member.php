<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/25-22:57
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Member extends BaseModel
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'usertime';
    protected $updateTime = '';
}