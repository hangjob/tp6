<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/7-12:24
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Leave as LeaveModel;

class Leave extends BaseController
{

    public function add(){
        $post = input('post.');
        validate(\app\validate\Leave::class)->batch(true)->check($post);
        $data = \think\facade\Request::only($post);
        $model = new LeaveModel();
        $model->save($data);
        $id = $model->id;
        if($id){
            return $this->showWebData(['data'=>$id]);
        }else{
            return $this->showWebData(['message'=>'小可爱，出错了','code'=>0]);
        }
    }


    public function items(){
        $model = new LeaveModel();
        $items = $model->order('id desc')->paginate(12,false);
        return $this->showWebData(['data'=>$items]);
    }

}