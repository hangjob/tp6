<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2021/4/18-0:37
 * Email: <470193837@qq.com>
 */


namespace app\api\controller;
use app\api\model\Navtag as ModelNavtag;
use app\api\model\Special as ModelSpecial;
use app\api\model\Taxonomic;
class Special extends BaseController
{

    public function list(){
        $data = (new Taxonomic())->where('is_special',1)->with(['spitems'])->select();
        return $this->showWebData(['data'=>$data]);
    }

    public function listids($id){
        $data = (new ModelSpecial())->where('pid',$id)->with(['taxonomic'=>function($query){
            $query->field('id,name');
        }])->select();
        return $this->showWebData(['data'=>$data]);
    }

    public function detailNav($id){
        $cid = (new ModelSpecial())->where('id',$id)->value('cid');
        $navtag = new ModelNavtag();
        $data['detail'] = $navtag->where('id',$cid)->with([
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
        $navtag->where('id',$cid)->inc('hits',1)->update();
        return $this->showWebData(['data'=>$data]);
    }
}