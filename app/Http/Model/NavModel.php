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

}
