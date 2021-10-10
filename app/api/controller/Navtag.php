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
use app\api\model\Navtheme;
use app\validate\AddNavtag;
use app\validate\AddNavtheme;
use app\api\model\Member;
use think\facade\Db;
use think\Request;

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
                $query->field('userid,userhead,username,userhome,description');
            },
            'zan'=>function($query){
                $query->limit(10)->with(['member'=>function($query){
                    $query->field('userid,userhead,username');
                }]);
            }
        ])->find();
        $navtag->where('id',$id)->inc('hits',1)->update();
        $data['popularIt'] = $this->popularIt();
        $data['latest'] = $navtag->order('id desc')->limit(6)->field('it_name,id,describe,pic')->select();
        $data['hot'] = $navtag->where('pic','not null')->order('hits desc')->limit(6)->field('it_name,id,describe,pic')->select();
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
        $data = $model->order('id desc')->field('id,it_name,describe,create_time,pic,icon,parentid,url')->with(['taxonomic'=>function($query){
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

    public function search(){
        $model = new ModelNavtag();
        $ks = input('ks');
        $data['nav'] = $model->where('it_name|describe|keywords','like','%'.$ks.'%')->order('id desc')->field('it_name,id,pic,icon,describe,create_time,author,keywords')->limit(15)->select();
        $data['article'] = (new Navtheme())->where('title|describe|keywords','like','%'.$ks.'%')->field('title,id,pic,describe,create_time,keywords')->limit(15)->select();
        return $this->showWebData(['data'=>$data]);
    }



    // 添加
    public function append(){

        $input = input('post.');
        $input['hits'] = 1;
        $input['create_time'] = time();
        $uerid = $this->getUserId();
        if($uerid){
            if($input['type'] == 1){
                $model = new ModelNavtag();
                unset($input['type']);
                validate(AddNavtag::class)->batch(true)->check($input);
                $data = \think\facade\Request::only($input);
                $model->save($data);
                (new Member())->where('userid',$uerid)->inc('point',10,30); // 发布推文奖励10分
                $id = $model->id;
                return $this->showWebData(['data'=>$id]);
            }
            if($input['type'] == 2){
                $model = new Navtheme();
                unset($input['type']);
                validate(AddNavtheme::class)->batch(true)->check($input);
                $data = \think\facade\Request::only($input);
                $model->save($data);
                (new Member())->where('userid',$uerid)->inc('point',10,30); // 发布推文奖励10分
                $id = $model->id;
                return $this->showWebData(['data'=>$id]);
            }
        }else{
            return $this->showWebData(['message'=>'小可爱，你还没登录呢！','code'=>0]);
        }
    }

}