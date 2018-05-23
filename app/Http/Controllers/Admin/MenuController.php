<?php

namespace App\Http\Controllers\admin;

use App\Http\model\MenuModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.menu',['only'=>['index','getApi']]);
        $this->middleware('PermissionCheck:create.menu', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.menu', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.menu', ['only' => ['delete']]);
    }



    //全部菜单分类
    public function index(){
        return view('admin.menu.list');
    }

    //菜单分类添加页面
    public function create(){
        $menu_data = self::getList(2); //获取导航数据
        return view('admin.menu_form_create',compact('menu_data'));
    }


    //菜单分类添加操作
    public function store(Requests\MenuCreateRequest $request)
    {
        $input = $request->except('_token');
        $status = MenuModel::create($input);
        if($status){
            Log::info(session('users.username').'添加菜单'.$input['title']);
            return response()->json(array(
                'status' => 200,
                'msg' => '添加菜单成功!',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '菜单新增失败，请稍后重试!',
            ));
        }
    }

    //菜单分类删除
    public function destroy(){
        $id = request()->id;
        $name = request()->name;
        $has = MenuModel::where('pid',$id)->first();
        if($has){
            return response()->json(array(
                'status' => -1,
                'msg' => '请先删除下级菜单！',
            ));
        }else{
            $status = MenuModel::where('id',$id)->delete();
            if($status){
                Log::info(session('users.username').'删除菜单'.$name);
                return response()->json(array(
                    'status' => 200,
                    'msg' => '菜单删除成功！',
                ));
            }else{
                return response()->json(array(
                    'status' => -2,
                    'msg' => '菜单删除失败，请稍后重试！',
                ));
            }
        }
    }
    //菜单分类修改操作
    public function update(Requests\MenuEditRequest $request){
        $input = $request->except('_token','_method');
        $status = MenuModel::where('id',$input['id'])->update($input);
        if($status){
            Log::info(session('users.username').'修改菜单'.$input['title']);
            return response()->json(array(
                'status' => 200,
                'msg' => '菜单修改成功！',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '菜单修改失败，请稍后重试！',
            ));
        }

    }

    //菜单分类修改页面
    public function edit($id){
        $menu_data = self::getList(2); //获取导航数据
        $data = MenuModel::where('id',$id)->first();
        return view('admin.menu_form_edit',compact('menu_data','data'));
    }

    //改变排序 AJAX
    public function changeOrder()
    {
        $input = Input::all();
        $data = MenuModel::find($input['id']);
        $data->order = $input['order'];
        $code = $data->update();
        if($code){
            $msg=[
                'status'=>'0',
                'info'=>'排序修改成功,请点击更新排序'
            ];
        }else{
            $msg=[
                'status'=>'1',
                'info'=>'系统错误请稍后重试'
            ];
        }
        return $msg;
    }

    public function show(){

    }


    /**
     * @param int $type
     * @return array|\Illuminate\Http\JsonResponse
     * 后台菜单不需要分页
     */
    public function getList($type=1)
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
       // $count = MenuModel::count();
        if($keywords == ''){
          //  $data = MenuModel::orderBy('order','desc')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
            $data = MenuModel::orderBy('order','desc')->orderBy($sort_field,$order)->get()->toArray();
            $n_data = (new MenuModel)->getTree($data);
            foreach ($n_data as $k => $v){
                $new_data[] = $v;
               foreach ($v['children'] as $a => $s){
                   $new_data[] = $s;
               }
            }
        }else{
            $new_data = MenuModel::where('title','like','%'.$keywords.'%')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }
        foreach ($new_data as $k => $v){
            if($v['pid'] != 0){
                $new_data[$k]['title'] = '&nbsp;&nbsp;└── '.$v['title'];
            }
           // $new_data[$k]['nav_wz'] = $v['nav_wz'] == 1 ? '头部' : '尾部';
           // $new_data[$k]['is_show'] = $v['is_show'] == 1 ? '√' : '×';
        }
        if($type == 2){
            foreach ($new_data as $k => $v){
                if($v['pid'] == 0){
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
