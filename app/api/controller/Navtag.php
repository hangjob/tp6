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
        $navtag = new ModelNavtag();
        $navItems = $navtag->with(['taxonomic'=>function($query){
            $query->field('id,name,parentid');
            $query->with(['primary'=>function($query){
                $query->field('id,name');
            }]);
        },'member'=>function($query){
            $query->field('userid,username');
        }])->where("pic",'not null')
            ->order('id desc')->field('id,describe,it_name,pic,keywords,create_time,parentid,uid')
            ->paginate(12,false);
        return $this->showWebData(['data'=>$navItems]);
    }



    public function detail(){
        $id = input('id');
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


    // 点赞
    public function addlike($id){
        $navtag = new ModelNavtag();
        $data = $navtag->where('id', $id)->inc('like', 1)->update();
        return $this->showWebData(['data'=>$data]);
    }


}