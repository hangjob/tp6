<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/30-0:35
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;


use app\api\model\Discuss as DiscussModel;
use app\api\model\Revert;
use think\facade\Request;

class Discuss extends BaseController
{

    // 评论列表
    public function items(){
        $post = input('post.');
        validate(\app\validate\Discuss::class)->batch(true)->check($post);
        $model = new DiscussModel();
        $where['fid'] = $post['fid'];
        $where['type'] = $post['type'];
        $data = $model->where($where)->with(['member'=>function($query){
            $query->field('userid,userhead,username,description');
        },'revertItems'=>function($query){
            $query->with(['member'=>function($query){
                $query->field('userid,userhead,username,description');
            }]);
        }])->select();
        return $this->showWebData(['data'=>$data]);
    }


    // 添加评论
    public function add(){
        $userid = $this->getUserId();
        if($userid){
            $post = input('post.');
            validate(\app\validate\DiscussAdd::class)->batch(true)->check($post);
            $model = new DiscussModel();
            $post['uid'] = $userid;
            $data = Request::only($post);
            $model->save($data);
            return $this->showWebData(['data'=>$model->id]);
        }else{
            return $this->showWebData(['message'=>'小可爱，请先登录','code'=>0]);
        }
    }

    public function addRevert(){
        $userid = $this->getUserId();
        if($userid){
            $post = input('post.');
            validate(\app\validate\Revert::class)->batch(true)->check($post);
            $model = new Revert();
            $post['uid'] = $userid;
            $data = Request::only($post);
            $model->save($data);
            return $this->showWebData(['data'=>$model->id]);
        }else{
            return $this->showWebData(['message'=>'小可爱，请先登录','code'=>0]);
        }
    }

}