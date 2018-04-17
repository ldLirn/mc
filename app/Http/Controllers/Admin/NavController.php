<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\NavModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.config',['only'=>['index','getList']]);
        $this->middleware('PermissionCheck:create.config', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.config', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.config', ['only' => ['destroy']]);
    }


    public function getList()
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
        if($keywords == ''){
            $data = NavModel::orderBy('nav_order','desc')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get();
        }else{
            $data = NavModel::where('nav_name','like','%'.$keywords.'%')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get();
        }
        $count = NavModel::count();

        return response()->json(array(
            'rel'  => 'ture',
            'msg'   => '',
            'count' => $count,
            'list'  => $data
        ));
    }
}
