<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/6-11:02
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Primary as PrimaryModel;

class Primary extends BaseController
{

    public function types(){
        $data = (new PrimaryModel())->where('shows',1)->field('name,id')->select();
        return $this->showWebData(['data'=>$data]);
    }

}