<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Role;
use App\Http\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;


class PowerController extends Controller
{

    public function __construct()
    {
        $this->middleware('PermissionCheck:list.admin',['only'=>['index','getApi']]);
        $this->middleware('PermissionCheck:create.admin', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.admin', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.admin', ['only' => ['delete']]);
    }

    public function index()
    {
        return view('admin.power_list');
    }

    public function getApi()
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
        if($keywords == ''){
            $data = User::with('roles')->where('is_admin','=','1')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }else{
            $data = User::with('roles')->where('name','like','%'.$keywords.'%')->orWhere('email','like','%'.$keywords.'%')->where('is_admin','=','1')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }
        $count = User::where('is_admin','=','1')->count();
        foreach ($data as $k=>$v){
            $data[$k]['role'] = $v['roles'][0]['description'];
            $data[$k]['last_login'] = date('Y-m-d H:i:s',$v['last_login']);
        }
        return response()->json(array(
            'rel'  => 'ture',
            'msg'   => '',
            'count' => $count,
            'list'  => $data
        ));
    }

    public function create()
    {
        $cate = Role::where('id','>','1')->get();
        return view('admin.power_form_create',compact('cate'));
    }

    public function store(Requests\PowerCreateRequest $request)
    {
        if(Input::method()=='POST'){
            $user = new User();
            $role_id = $request->role_id;
            $input = $request->except('_token','password_confirmation','role_id');
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = encrypt($input['password']);
            $user->status = $input['status'];
            $user->is_admin = '1';
            $user->last_login = time();
            if($user->save()){
                Log::info(session('users.admin_name').'添加管理员'.$input['name']);
                // 自动更新用户角色关系
                if (isset($role_id) && $role_id) {
                    $arr = array('0'=>$role_id);
                    $user->role()->sync($arr);
                    return response()->json(array(
                        'status' => 200,
                        'msg' => '添加成功',
                    ));
                }else{
                    return response()->json(array(
                        'status' => -1,
                        'msg' => '角色不存在',
                    ));
                }
            }else{
                return response()->json(array(
                    'status' => -2,
                    'msg' => '管理员新增失败，请稍后重试',
                ));
            }
        }
    }

    public function update(Requests\PowerEditRequest $request)
    {
        if(Input::method()=='POST'){
            if($request->id == 1){
                return response()->json(array(
                    'status' => -3,
                    'msg' => '此管理不允许修改',
                ));
            }
            $user = User::find($request->id);
            $role_id = $request->role_id;
            $user->email = $request->email;
            $user->status = $request->status;
            if($request->password != ''){
                $user->password = encrypt($request->password);
            }
            if($user->save()){
                Log::info(session('users.admin_name').'修改管理员'.$user['name']);
                // 自动更新用户角色关系
                if (isset($role_id) && $role_id) {
                    $arr = array('0'=>$role_id);
                    $user->role()->sync($arr);
                    return response()->json(array(
                        'status' => 200,
                        'msg' => '修改成功',
                    ));
                }else{
                    return response()->json(array(
                        'status' => -1,
                        'msg' => '角色不存在',
                    ));
                }
            }else{
                return response()->json(array(
                    'status' => -2,
                    'msg' => '管理员修改失败，请稍后重试',
                ));
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 修改页面表单
     */
    public function edit($id)
    {
        $cate = Role::where('id','>','1')->get();
        $data = User::with('role')->find($id)->toArray();
        if ($data['role']) {
            $data['role'] =$data['role']['0']['id'];
        }
        return view('admin.power_form',compact('cate','data'));
    }

    public function delete()
    {
        if(Input::method()=='POST'){
            $id = request()->id;
            if($id == 1){
                return response()->json(array(
                    'status' => -1,
                    'msg' => '此管理不允许删除',
                ));
            }
            $status = User::destroy($id);
            if($status){
                DB::table('role_user')->where('user_id',$id)->delete();
                Log::info(session('users.admin_name').'删除管理id='.$id);
                return response()->json(array(
                    'status' => 200,
                    'msg' => '管理员删除成功!',
                ));
            }else{
                return response()->json(array(
                    'status' => -2,
                    'msg' => '管理员删除失败，请稍后重试!',
                ));
            }
        }
    }
}
