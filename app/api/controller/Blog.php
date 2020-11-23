<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-19:48
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Ads as AdsModel;
use app\validate\Ads as AdsValidate;

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
        // 验证数据
        validate(AdsValidate::class)->batch(true)->check(['adURL'=>'123456','adName'=>'测试数据']);
        ( new AdsModel())->insert(['adURL'=>time()]);
    }

}