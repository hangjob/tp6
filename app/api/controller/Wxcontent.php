<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/4-23:27
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Wxcontent as ModelWxcontent;

class Wxcontent extends BaseController
{

    public function items(){
        $model = new ModelWxcontent();
        $data = $model->order('id desc')->paginate(10,true);
        return $this->showWebData(['data'=>$data]);
    }



    public function detail($id){
        $model = new ModelWxcontent();
        $data = $model->where('id',$id)->find();
        return $this->showWebData(['data'=>$data]);
    }


    public function category($id){
        $detail = (new Primary())->where(['id'=>$id])->find();
        $taxonomic = (new Taxonomic())->where(['parentid'=>$detail['id']])
                    ->with('navtag')->field('name,des,icon,id,parentid,create_time')
                    ->withCount('navtag')->limit(30)->select();

    }



    public function groups(){
        $model = new ModelWxcontent();
        $time = 3600 * 8;
        $data['HOT'] = $model->where('ArticleType','HOT')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['CAT'] = $model->where('ArticleType','CAT')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['GAME'] = $model->where('ArticleType','GAME')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['MILITARY'] = $model->where('ArticleType','MILITARY')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['SPORTS'] = $model->where('ArticleType','SPORTS')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->cache($time)->select();
        $data['HOROSCOPE'] = $model->where('ArticleType','HOROSCOPE')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['EDUCATION'] = $model->where('ArticleType','EDUCATION')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['HISTORY'] = $model->where('ArticleType','HISTORY')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['WORK'] = $model->where('ArticleType','WORK')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['TRAVEL'] = $model->where('ArticleType','TRAVEL')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['FASHION'] = $model->where('ArticleType','FASHION')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['LIFE'] = $model->where('ArticleType','LIFE')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['CAR'] = $model->where('ArticleType','CAR')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['FINANCE'] = $model->where('ArticleType','FINANCE')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['TECH'] = $model->where('ArticleType','TECH')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        $data['FUNNY'] = $model->where('ArticleType','FUNNY')->limit(12)->field('ArticleTitle,ArticleType,ArticlePublishDateTime,id')->order('id desc')->cache($time)->select();
        return $this->showWebData(['data'=>$data]);
    }

}