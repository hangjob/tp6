<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-23:58
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Primary extends BaseModel
{

    public function taxonomic(){
        return $this->hasMany('Taxonomic','parentid','id');
    }

}