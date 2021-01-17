<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/17-12:06
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Navtag;
use app\api\model\Member;

class Configuration extends BaseController
{
    public function navcount(){
        $model = new Navtag();
        $member = new Member();
        $data['all'] = $model->count();
        $data['lastweek'] = $model->whereTime('create_time', 'last week')->count();
        $data['lastmonth'] = $model->whereTime('create_time', 'last month')->count();
        $data['userall'] = $member->count() + 1000;
        $data['userlastmonth'] = $member->whereTime('usertime', 'last month')->count() + 30;
        return $this->showWebData(['data'=>$data]);
    }

}