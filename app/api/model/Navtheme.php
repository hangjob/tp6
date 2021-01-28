<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/24-17:11
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Navtheme extends BaseModel
{
    protected $autoWriteTimestamp = true;    //开启自动写入时间戳
    protected $createTime = 'create_time';   //数据添加的时候，create_time 这个字段自动写入时间戳
    protected $updateTime = 'update_time';     //数据更新的时候，update_at 这个字段自动写入时间戳

    // 处理字段
    public function getPicAttr($value,$data){
        return $this->urlPrefix($value,$data);
    }


    // 用户
    public function member(){
        return $this->hasOne('Member','userid','uid');
    }

    public static function addOne(){
        $id = input('id');
        self::where('id','=',$id)->setInc('hits',1,60);
    }


    public function taxonomic(){
        return $this->hasOne('Taxonomic','id','parentid');
    }


    public function recommended(){
        return self::where('shows',1)->field('title,pic,create_time,id')->limit(4)->order('hits desc')->select();
    }

}