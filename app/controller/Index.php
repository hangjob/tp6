<?php
namespace app\controller;

use app\BaseController;

class Index extends BaseController
{

    protected  $middleware  = [
        // only指定方法 执行中间件
        'auth' => ['only'=>['hello']]
    ];

    public function index()
    {
        return 111;
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
