<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-19:48
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;


class Blog extends BaseController
{

    protected  $middleware  = [
        // only指定方法 执行中间件
        'auth' => ['only'=>['detail']]
    ];

    public function index(){
        return '博客';
    }

    public function home(){
        return '博客home';
    }

    public function detail($id){
        echo $id;
    }

    public function abnormal(){
        echo '异常处理';
        $err = [
            'msg'=>'sign验签不能为空'
        ];
        abort(404, '页面异常');
    }

}