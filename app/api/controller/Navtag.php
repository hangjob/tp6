<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-13:30
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Navtag as ModelNavtag;

class Navtag extends BaseController
{

    public function items(){

    }

    public function detail($id){
        $navtag = new ModelNavtag();
        $detail = $navtag->where('id',$id)->with([
            'taxonomic'=>function($query){
                $query->field('id,name,parentid,des');
                $query->with(['primary'=>function($query){
                    $query->field('id,name,mark,des');
                }]);
            },
            'member'=>function($query){
                $query->field('userid,userhead,username,userhome');
            },
            'zan'=>function($query){
                $query->limit(10)->with(['member'=>function($query){
                    $query->field('userid,userhead,username');
                }]);
            }
        ])->find();
        return $this->showWebData(['data'=>$detail]);
    }



}