<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/25-22:57
 * Email: <470193837@qq.com>
 */


namespace app\api\model;


class Member extends BaseModel
{

    protected $autoWriteTimestamp = true;
    protected $createTime = 'usertime';
    protected $updateTime = '';


    // 全局查询范围
    // 定义全局的查询范围
    protected $globalScope = ['status'];

    public function scopeStatus($query)
    {
        $query->where('status',1);
    }

    // 获取用户信息
    public function getUserInfo($key, $uid){
        return self::where($key, $uid)->find();
    }

    public function getUserheadAttr($value,$data){
        $ret = strstr($value, "https");
        if ($ret){
            return $value;
        }else{
            return $this->urlPrefix($value,$data);
        }
    }

    public function getUserhomeAttr($value,$data){
        if(empty($value)){
            $arr['city'] = '中国';
        }else{
            $arr['city'] = $value;
        }
        $arr['occupation'] = 'Web全栈工程师';
        return $arr;
    }

}