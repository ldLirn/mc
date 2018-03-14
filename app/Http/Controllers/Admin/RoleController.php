<?php

namespace App\Http\Controllers\admin;

use App\Http\Model\Permission;
use App\Http\Model\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{


/*
Log::emergency($error);     //紧急状况，比如系统挂掉
Log::alert($error);     //需要立即采取行动的问题，比如整站宕掉，数据库异常等，这种状况应该通过短信提醒
Log::critical($error);     //严重问题，比如：应用组件无效，意料之外的异常
Log::error($error);     //运行时错误，不需要立即处理但需要被记录和监控
Log::warning($error);    //警告但不是错误，比如使用了被废弃的API
Log::notice($error);     //普通但值得注意的事件
Log::info($error);     //感兴趣的事件，比如登录、退出
Log::debug($error);     //详细的调试信息
*/
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.role',['only'=>['index','getApi']]);
        $this->middleware('PermissionCheck:create.role', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.role', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.role', ['only' => ['delete']]);
    }


    public function index()
    {
        return view('admin.power_role');
    }


    public function create(){
        $permission = new Permission();
        $power = $permission->getTree($permission->all());
        return view('admin.power_role_create',compact('power'));
    }

    public function store(Requests\RoleCreateRequest $request)
    {
        $input = $request->except('_token');
        $arr = explode(',',rtrim($input['permission'],','));
        $role = new Role();
        $role->name = $input['name'];
        $role->slug = $input['name'];
        $role->description = $input['description'];
        $role->level = $input['level'];
        $adminRole = $role->save();
        if($adminRole){
            //自动更新角色权限关系
            if (isset($arr)){
                $role->permission()->sync($arr);
            }
            Log::info(session('users.username').'添加角色'.$input['name']);
            return response()->json(array(
                'status' => 200,
                'msg' => '角色新增成功，即将关闭此页面',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '角色新增失败，请稍后重试',
            ));
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 修改页面
     */
    public function edit($id){
        $role = Role::with('permission')->find($id);  // 获取当前角色的信息和权限
        if ($role) {
            $data = $role->toArray();
            if ($data['permission']) {
                $data['permission'] = array_column($data['permission'],'id');
            }
        }
        $permission = new Permission();
        $power = $permission->getTree($permission->all());  //获取所有的权限
        return view('admin.power_role_edit',compact('power','data'));
    }

    public function update(Requests\RoleEditRequest $request)
    {
        $input = $request->except('_token');
        $role = Role::find($input['id']);
        $arr = explode(',',rtrim($input['permission'],','));
        $role->id = $input['id'];
        $role->name = $input['name'];
        $role->slug = $input['name'];
        $role->description = $input['description'];
        $role->level = $input['level'];
        $adminRole = $role->save();
        if ($adminRole) {
            //自动更新角色权限关系
            if (isset($arr)){
                $role->permission()->sync($arr);
            }
            Log::info(session('users.username').'修改角色'.$input['name']);
            return response()->json(array(
                'status' => 200,
                'msg' => '修改角色成功，即将关闭此页面',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '修改角色失败，请稍后重试',
            ));
        }
    }


    /**
     * @param $id
     * @return array
     * 删除角色
     */
    public function delete(){
        $id = request()->id;
        $role = Role::with('users')->find($id)->toArray();
        if($role['users']) {
            $data = [
                'status' => -2,
                'msg' => '请先删除拥有此角色的管理员！',
            ];
        }else{
            $isDelete = Role::destroy($id);
            if($isDelete){
                DB::table('permission_role')->where('role_id',$id)->delete();
                Log::info(session('users.username').'删除角色'.$role['description']);
                $data = [
                    'status' => 200,
                    'msg' => '删除角色成功！',
                ];
            }else{
                $data = [
                    'status' => -1,
                    'msg' => '删除角色失败，请稍后重试！',
                ];
            }
        }
        return $data;
    }

    public function getRoleApi()
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
        if($keywords == ''){
            $data = Role::offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }else{
            $data = Role::where('name','like','%'.$keywords.'%')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }
        $count = Role::count();
        return response()->json(array(
            'rel'  => 'ture',
            'msg'   => '',
            'count' => $count,
            'list'  => $data
        ));
    }
}
