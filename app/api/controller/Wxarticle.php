<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/6-18:20
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Wxcontent as ModelWxcontent;
use app\api\model\Wxarticle as ModelWxarticle;

class Wxarticle extends BaseController
{

    public function correlation(){
        $model = new ModelWxarticle();
        $data['new'] = $model->limit(12)->order('id desc')->select();
        $data['record'] = (new \app\api\model\Navtag())->limit(12)->order('id desc')->field('it_name,id,describe')->select();
        $data['wx'] = (new ModelWxcontent())->where('ArticleType','TECH')->limit(12)->order('id desc')->field('ArticleTitle,id,ArticleType')->select();
        $data['wxsj'] = (new ModelWxcontent())->where('ArticleType','HOT')->limit(20)->field('ArticleTitle,id,ArticleType')->select();
        return $this->showWebData(['data'=>$data]);
    }

}