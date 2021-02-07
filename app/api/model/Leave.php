<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/7-12:32
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Leave extends BaseModel
{

    protected $autoWriteTimestamp = true;    //开启自动写入时间戳
    protected $createTime = 'create_time';   //数据添加的时候，time 这个字段不自动写入时间戳
    protected $updateTime = '';     //数据更新的时候，update_at 这个字段自动写入时间戳


    protected $globalScope = ['shows'];

    public function scopeShows($query)
    {
        $query->where('shows',1);
    }

}