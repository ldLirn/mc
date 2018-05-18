<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\NavModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.config',['only'=>['index','getList']]);
        $this->middleware('PermissionCheck:create.config', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.config', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.config', ['only' => ['destroy']]);
    }

    public function store(Requests\NavCreateRequest $request)
    {
        $input = $request->except('_token');
        $input['is_show'] = isset($input['is_show']) ? 1 : 0;
        $status = NavModel::create($input);
        if($status){
            Log::info(session('users.admin_name').'添加自定义导航'.$input['nav_name']);
            return response()->json(array(
                'status' => 200,
                'msg' => '新增成功',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '新增失败，请稍后重试',
            ));
        }
    }

    public function create()
    {
        $nav_data = self::getList(2); //获取导航数据

        return view('admin.nav_form_create',compact('nav_data'));
    }

    public function edit($id)
    {
        $data = NavModel::find($id);
        $nav_data = self::getList(2); //获取导航数据
        return view('admin.nav_form_edit',compact('data','nav_data'));
    }

    public function update(Requests\NavEditRequest $request,$id)
    {
        $input = $request->except('_token','_method','id');
        $status = NavModel::where('id',$id)->update($input);
        if($status){
            Log::info(session('users.admin_name').'修改导航'.$input['nav_name']);
            return response()->json(array(
                'status' => 200,
                'msg' => '修改导航成功!',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '修改导航失败，请稍后重试!',
            ));
        }
    }

    public function destroy()
    {
        $id = request()->id;
        $name = request()->name;
        $data = NavModel::find($id)->toArray();
        if($data['p_id'] == 0){   //判断有没下级，有则不能直接删除
            if(NavModel::where('p_id','$id')->select()){
                return response()->json(array(
                    'status' => -2,
                    'msg' => '请先删除下级导航!',
                ));
            }
        }
        $status = NavModel::destroy($id);
        if($status){
            Log::info(session('users.admin_name').'删除网站导航['.$name.']');
            return response()->json(array(
                'status' => 200,
                'msg' => '网站导航删除成功!',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '网站导航删除失败，请稍后重试!',
            ));
        }
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * 数据接口
     * 导航类不需要分页
     */
    public function getList($type=1)
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
        $count = NavModel::count();
        if($keywords == ''){
            //$data = NavModel::orderBy('nav_order','desc')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
            $data = NavModel::orderBy('nav_order','desc')->orderBy($sort_field,$order)->get()->toArray();
            for($i = 0; $i <= $count-1; $i++){   //TODO 此处采用冒泡排序，如有更好的方法
                for($j = $i+1; $j <= $count-1; $j++){
                    if($data[$i]['id'] == $data[$j]['p_id'] && $data[$i]['p_id'] == 0){
                        $new_data[$i] = $data[$i];
                        $new_data[$j] = $data[$j];
                    }
                }
            }
            $new_data = array_values($new_data + $data);   //重置数组索引，前端数据需要，不然读不出数据
        }else{
            $new_data = NavModel::where('nav_name','like','%'.$keywords.'%')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }

       foreach ($new_data as $k => $v){
           if($v['p_id'] != 0){
               $new_data[$k]['nav_name'] = '&nbsp;&nbsp;└── '.$v['nav_name'];
           }
           $new_data[$k]['nav_wz'] = $v['nav_wz'] == 1 ? '头部' : '尾部';
           $new_data[$k]['is_show'] = $v['is_show'] == 1 ? '√' : '×';
       }
       if($type == 2){
           foreach ($new_data as $k => $v){
                if($v['p_id'] == 0){
                    $nav_data[] = $v;
                }
           }
           return $nav_data;
       }else{
           return response()->json(array(
               'rel'  => 'ture',
               'msg'   => '',
               'count' => '1',
               'list'  => $new_data
           ));
       }
    }
}
