<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/24-21:35
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;


class Login extends BaseController
{

    public function login(){
        $post = input('post.');
        validate(\app\validate\Login::class)->batch(true)->check($post);
    }

}