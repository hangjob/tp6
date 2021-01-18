<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/6-15:43
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Taxonomic as ModelTaxonomic;

class Taxonomic extends BaseController
{

    public function items(){
        $id = input('id');
        $taxonomic = new ModelTaxonomic();
        $data['info'] = (new \app\api\model\Primary())->where('id',$id)->find();
        $data['items'] = $taxonomic->where('parentid',$id)->field('id,parentid,name')->with(['navtag'=>function($query){
            $query->withLimit(3)->order('id desc')->field('id,describe,it_name,pic,keywords,create_time,parentid,uid,icon,author');
        }])->limit(12)->select();
        return $this->showWebData(['data'=>$data]);
    }

    // 知道你喜欢
    public function youlike(){
        $id = input('id');
        $taxonomic = new ModelTaxonomic();
        $data = $taxonomic->where('parentid',$id)->field('id,parentid,name')->with(['navtag'=>function($query){
            $query->withLimit(4)->order('id desc')->field('id,describe,it_name,pic,parentid,uid,icon,author');
        }])->limit(4)->select();
        return $this->showWebData(['data'=>$data]);
    }

}