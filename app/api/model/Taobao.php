<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/17-22:15
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Taobao extends BaseModel
{
    public function getImgAttr($value,$data){
        if($value){
            return $this->urlPrefix($value,$data);
        }else{
            return null;
        }
    }
}