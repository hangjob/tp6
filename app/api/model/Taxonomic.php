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

    public function items(){
        return $this->hasMany('Navtag','parentid','id')
            ->field('it_name,id,describe,parentid,shows,keywords,pic')->withLimit(4);
    }


    public function getDesAttr($value,$data){
        $filtrate = ['论坛', 'MySQL', 'JQuery', '人工智能'];
        $isIn = in_array($value,$filtrate);
        if(!$isIn){
            $str1 = $this->splitString($value,$data,'个');
            $str2 = $this->splitString($value,$data,'款');
            if($str1){
                return $str1;
            }
            if($str2){
                return $str2;
            }
        }
        return $value;
    }

    public function splitString($value,$data,$str)
    {
        $len = strpos($value, $str);
        if ($len !== false) {
            $str1 = substr($value, 0, $len);
            $str2 = substr($value, $len, strlen($value));
            $data['navtag_count'] = empty($data['navtag_count']) ? '' : $data['navtag_count'];
            return $str1 . $data['navtag_count'] . $str2;
        } else {
            return false;
        }
    }

}