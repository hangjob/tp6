<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/2/6-17:20
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Appdownload as AppdownloadModel;
use app\api\model\Navtheme;

class Appdownload extends BaseController
{

    public function items(){
        $data = (new AppdownloadModel())->field('id,name,icon,pic,win,mac,pas,hits')->order('id desc')->limit(8)->select();
        return $this->showWebData(['data'=>$data]);
    }


    public function ranking(){
        $where['pic'] = array('exp', 'is not null');
        $data['theme'] = (new Navtheme())->field('title,describe,id,pic')->order('id asc')->limit(10)->select();
        $data['down'] = (new AppdownloadModel())->field('name,pic,icon,id,pas,des,hits,win,mac')->limit(10)->select();
        return $this->showWebData(['data'=>$data]);
    }

}