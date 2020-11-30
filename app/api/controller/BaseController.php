<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-22:40
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;

use app\api\lib\ResponseJson;
use think\facade\Db;

class BaseController extends \app\BaseController
{

    public function showWebData($params=[]){

        if(empty($params['data'])){
            $data['data'] = [];
        }else{
            $data['data'] = $params['data'];
        }

        if(key_exists('message',$params)){
            $data['message'] = $params['message'];
        }else{
            $data['message'] = '请求成功';
        }

        if(key_exists('code',$params)){
            $data['code'] = $params['code'];
        }else{
            $data['code'] = 1 ;
        }

        if(key_exists('httpCode',$params)){
            $httpCode = $params['httpCode'];
        }else{
            $httpCode = 200;
        }
        return (new ResponseJson())->jsonResponse($data['code'], $data['message'], $data['data'], $httpCode);
    }


    public function getUserId(){
        $uid = session('userid');
        if (!empty($uid)){
            $data = Db::table('tpt_member')->where('userid', $uid)->field('userid')->value('userid');
            return $data;
        }else{
            return false;
        }
    }
}