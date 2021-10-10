<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/4/18-0:36
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Special extends BaseModel
{

    protected $globalScope = ['shows'];

    public function scopeShows($query)
    {
        $query->where('shows',1);
    }

    public function taxonomic(){
        return $this->hasOne('Taxonomic','id','pid');
    }
}