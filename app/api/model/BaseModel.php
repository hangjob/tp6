<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/23-22:14
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


use think\Model;

class BaseModel extends Model
{

    public function urlPrefix($value){
        //阔以做更多灵活的配置，比如区分本地图片或者网络图片
        $url = config('setting.url_prefix').$value;
        return $url;
    }

    public function member(){
        return $this->hasOne('Member','userid','uid');
    }

    public function getPimgAttr($value){
        return $this->urlPrefix($value);
    }

    public function getPicAttr($value,$data){
        if($value){
            return $this->urlPrefix($value,$data);
        }else{
            return null;
        }
    }

    public function getIconAttr($value,$data){
        return $this->urlPrefix($value,$data);
    }

    // 处理关键词
    public function getKeywordsAttr($value){
        $arr = [];
        if($value){
            $arr = explode(",",$value);
        }
        return $arr;
    }

}