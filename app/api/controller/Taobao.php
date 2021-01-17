<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/17-22:15
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Taobao as TaobaoModel;

class Taobao extends BaseController
{

    public function items(){
        $model = new TaobaoModel();
        $data = $model->where('shows',1)->select();
        return $this->showWebData(['data'=>$data]);
    }

}