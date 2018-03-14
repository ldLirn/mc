<?php

namespace App\Http\model;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $guarded=[];
    public $timestamps = false;

    
    public function getTree($data,$pid=0)
    {
        $arr = [];
        foreach($data as $k => $v){
            if($v['pid'] == $pid){
                $arr[$k] = $v;
                $arr[$k]['children'] = self::getTree($data,$v['id']);
            }
        }
        return $arr;
    }

    public function to_json($data)
    {
        $arr = [];
        foreach ($data as $k => $v){
            $arr['json'][$k] = $v;
            $arr['json'][$k]['children'] = array_values($v['children']);
        }
        return json_encode(array_values($arr['json']),JSON_UNESCAPED_UNICODE);
    }
}
