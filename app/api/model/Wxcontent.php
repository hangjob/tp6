<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/4-23:27
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Wxcontent extends BaseModel
{
    protected $globalScope = ['shows'];

    public function scopeStatus($query)
    {
        $query->where('shows',1);
    }

}