<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/24-21:35
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Member;
use app\api\model\Inform;
use think\facade\Session;

class Login extends BaseController
{

    public function login(){
        $post = input('post.');
        validate(\app\validate\Login::class)->batch(true)->check($post);
        $member = new Member();
        $user = $member->getUserInfo('usermail',$post['usermail']);
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
            $user = $member->getUserInfo('userid',$userid);
            return $this->showWebData(['data'=>$user->hidden(['password','validate','userip'])]);
        }else{
            return $this->showWebData(['message'=>'小可爱，还未登录','code'=>0]);
        }
    }

    public function register(){
        $post = input('post.');
        validate(\app\validate\Register::class)->batch(true)->check($post);
        $model = new Member();
        $user = $model->where('usermail',$post['usermail'])->find();
        if(!$user){
            $password = $post['password'];
            $post['usertime'] = time();
            $post['usertimes'] = time();
            $post['validate'] = substr(md5($post['username'].$post['usermail']), 8, 16);
            $post['count'] = 1;
            $sex = mt_rand(0,1);
            $post['sex'] = $sex; // 随机性别
            $post['grades'] = 0;
            $post['status'] = 1;
            $post['type'] = 0; // 账号密码注册的用户
            $post['point'] = 20; // 分数
            $userhead = mt_rand(1,20);
            $post['userhead'] = '/uploads/20170401/'.$userhead.'.png'; // 随机选头像
            $post['password'] = md5($password);
            $userId = $model->strict(false)->insertGetId($post);
            $data['uid'] = $userId;
            $data['type'] = 30; // 注册完成后-通知扫二维码
            (new Inform())->data($data)->save();
            return $this->showWebData();
        }else{
            return $this->showWebData(['message'=>'账号已注册，请前往登录','code'=>0]);
        }
    }

}