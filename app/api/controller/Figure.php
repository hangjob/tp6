<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/18-23:22
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Figure as FigureModel;

class Figure extends BaseController
{

    public function items(){
        $model = new FigureModel();
        $data = $model->where('shows',1)->order('id desc')->paginate(25,false);
        return $this->showWebData(['data'=>$data]);
    }


    public function bans(){
        $model = new FigureModel();
        $data = $model->where('shows',1)->field('img,id,shows,title')->order('id desc')->limit(10)->select();
        return $this->showWebData(['data'=>$data]);
    }
}