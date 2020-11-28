<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-13:30
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Navtag extends BaseModel
{
    protected $autoWriteTimestamp = true;    //开启自动写入时间戳
    protected $createTime = 'create_time';   //数据添加的时候，time 这个字段不自动写入时间戳
    protected $updateTime = 'update_time';     //数据更新的时候，update_at 这个字段自动写入时间戳


    public function getImgsAttr($value,$data){
        if($value){
            return $this->urlPrefix($value,$data);
        }else{
            return '';
        }
    }

    public function taxonomic(){
        return $this->hasOne('Taxonomic','id','parentid');
    }

    // 用户访问记录
    public function zan(){
        return $this->hasMany('Zan','fid','id')->where('type',1);
    }

}