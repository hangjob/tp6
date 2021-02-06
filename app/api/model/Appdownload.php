<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/6-17:20
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Appdownload extends BaseModel
{

    protected $globalScope = ['shows'];

    public function scopeShows($query)
    {
        $query->where('shows',1);
    }

    public function getHitsAttr($value,$data){
        $color = config('color');
        $index = array_rand($color,1);
        $obj['color'] = $color[$index];
        $obj['name'] = $value;
        return $obj;
    }

}