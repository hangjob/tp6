<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/1/24-17:11
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Navtheme as NavthemeModel;

class Navtheme extends BaseController
{


    public function items(){
        $navTheme = (new NavthemeModel())->where('shows',1)
            ->field('id,describe,title,pic,create_time')->order('id desc')->paginate(12,false);

        return $this->showWebData(['data'=>$navTheme]);
    }


    public function detail(){
        $id = input('id');
        $navtheme = new NavthemeModel();
        $detail = $navtheme->where('id',$id)->with(['member'=>function($query){
            $query->field('userid,username,description,userhead');
        },'taxonomic'=>function($query){
            $query->field('name,id,parentid');
            $query->with('primary');
        }])->find();
        return $this->showWebData(['data'=>$detail]);
    }
}