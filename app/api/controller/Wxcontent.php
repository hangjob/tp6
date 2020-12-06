<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/12/4-23:27
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Wxcontent as ModelWxcontent;

class Wxcontent extends BaseController
{

    public function items(){
        $model = new ModelWxcontent();
        $data = $model->order('id desc')->paginate(10,true);
        return $this->showWebData(['data'=>$data]);
    }



    public function detail($id){
        $model = new ModelWxcontent();
        $data = $model->where('id',$id)->find();
        return $this->showWebData(['data'=>$data]);
    }


    public function category($id){
        $detail = (new Primary())->where(['id'=>$id])->find();
        $taxonomic = (new Taxonomic())->where(['parentid'=>$detail['id']])
                    ->with('navtag')->field('name,des,icon,id,parentid,create_time')
                    ->withCount('navtag')->limit(30)->select();

    }

}