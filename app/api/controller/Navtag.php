<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/28-13:30
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Navtag as ModelNavtag;
use app\api\model\Taxonomic;
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
        $data['detail'] = $navtag->where('id',$id)->with([
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
        $data['popularIt'] = $this->popularIt();
        $data['prv'] = $navtag->where('id','>',$data['detail']['id'])->order('id asc')->field('it_name,icon,id,pic,describe,create_time')->limit('1')->find();
        $data['nxet'] = $navtag->where('id','<',$data['detail']['id'])->order('id desc')->field('it_name,icon,id,pic,describe,create_time')->limit('1')->find();
        return $this->showWebData(['data'=>$data]);
    }


    // 点赞
    public function addlike($id){
        $navtag = new ModelNavtag();
        $data = $navtag->where('id', $id)->inc('like', 1)->update();
        return $this->showWebData(['data'=>$data]);
    }


    // 热点
    public function popularIt(){
        $model = new ModelNavtag();
        $data = $model->where('hits >= 1000  AND shows = 1')->limit(10)->select();
        return $data;
    }


    // 每日推荐
    public function daily(){
        $model = new ModelNavtag();
        $data = $model->order('id desc')->with(['taxonomic'=>function($query){
            $query->field('id,name,parentid,des');
            $query->with(['primary'=>function($query){
                $query->field('id,name,mark,des');
            }]);
        }])->limit(10)->select();
        return $this->showWebData(['data'=>$data]);
    }


    public function category(){
        $taxonomic = (new Taxonomic())->where('shows',1)->with('items')
            ->field('name,des,icon,id,parentid,create_time')->withCount('navtag')
            ->paginate(12,false);
        return $this->showWebData(['data'=>$taxonomic]);
    }

}