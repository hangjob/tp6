<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-23:56
 * Email: <470193837@qq.com>
 */


namespace app\api\model;

class Taxonomic extends BaseModel
{


    public function primary(){
        return $this->hasOne('Primary','id','parentid');
    }


    public function navtag(){
        return $this->hasMany('Navtag','parentid','id');
    }

}