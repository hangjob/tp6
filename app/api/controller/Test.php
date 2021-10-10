<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/3/9-23:50
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;


use think\facade\Db;

class Test extends BaseController
{

    public function index(){
        return '1';
    }

    public function items(){
        header('Content-type: text/plain');
        $data = Db::table('tpt_test')->select();
        return '111';
    }

    public function delete(){
        $id = input('id');
        Db::table('tpt_test')->delete($id);
        return $this->showWebData();
    }

    public function put(){
        $data = input('put.');
        $data['create_time'] = date('Y-m-d H:i:s',time());
        Db::table('tpt_test')->save($data);
        return $this->showWebData();
    }

    public function add(){
        $data = input('post.');
        $data['create_time'] = date('Y-m-d H:i:s',time());
        Db::table('tpt_test')->save($data);
        return $this->showWebData();
    }
}