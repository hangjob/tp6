<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/1-0:31
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Revert extends BaseModel
{

    protected $autoWriteTimestamp = true;

    protected $globalScope = ['shows'];

    public function scopeStatus($query)
    {
        $query->where('shows',1);
    }


}