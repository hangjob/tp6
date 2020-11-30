<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/30-0:26
 * Email: <470193837@qq.com>
 */


namespace app\api\model;

class Discuss extends BaseModel
{

    protected $autoWriteTimestamp = true;

    protected $globalScope = ['shows'];

    public function scopeStatus($query)
    {
        $query->where('shows',1);
    }

    public function revertItems(){
        return $this->hasMany('revert','did','id');
    }

}