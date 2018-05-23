<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class NavModel extends Model
{
    protected $table="nav";
    //protected $primaryKey="";
    protected $guarded=[];

    public $timestamps = false;




    //递归查询
    public function getTree($dig_list=array(),$pid=0,$level=0){
        $list = $dig_list;
        foreach($list as $k=>$v){
            for($i=0;$i<$level;$i++){
                $v['nav_name']='└─ '.$v['nav_name'];
            }
            $v['p_id'] = $v['p_id'] == 0 ? '顶级分类': '';
            $dig_list[]=$v;
            $dig_list=self::getTree($dig_list,$v['id'],$level+1);
        }
        return $dig_list;
    }


    public function getTree1($data,$pid=0)
    {
        $arr = [];
        foreach($data as $k => $v){
            if($v['p_id'] == $pid){
                $arr[$k] = $v;
                $arr[$k]['children'] = self::getTree1($data,$v['id']);
            }
        }
        return $arr;
    }

    /**
     * @param int $type   类型
     * @return array
     */
    public function getNav($type = 1)
    {
        $data = NavModel::where('nav_wz',$type)->where('is_show',1)->orderBy('nav_order','desc')->get()->toArray();
        $n_data = self::getTree1($data);
        return $n_data;
    }

}
