<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/24-21:35
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Member;

class Login extends BaseController
{

    public function login(){
        $post = input('post.');
        validate(\app\validate\Login::class)->batch(true)->check($post);
        $member = new Member();
        $user = $member->where('usermail',$post['usermail'])->where('status',1)->find();
        if($user){
            if($user['password'] === md5($post['password'])){
                session(null);
                session('userid',$user['userid']);
                return $this->showWebData(['data'=>$user->hidden(['password','validate','userip'])]);
            }else{
                return $this->showWebData(['message'=>'密码错误','code'=>0]);
            }
        }else{
            return $this->showWebData(['message'=>'无此用户或者已被禁用','code'=>0]);
        }
    }

    public function userinfo(){
        $userid = session('userid');
        if($userid){
            $member = new Member();
            $user = $member->where('userid',$userid)->find();
            return $this->showWebData(['data'=>$user->hidden(['password','validate','userip'])]);
        }else{
            return $this->showWebData(['message'=>'小可爱，还未登录','code'=>0]);
        }
    }

    public function register(){
        $post = input('post.');
        validate(\app\validate\Register::class)->batch(true)->check($post);
    }

}