<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.user',['only'=>['index','getList']]);
        $this->middleware('PermissionCheck:create.user', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.user', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.user', ['only' => ['destroy']]);
    }



    public function create()
    {
        return view('admin.user_form_create');
    }

    public function store(Requests\UserCreateRequest $request)
    {
        $input = $request->except('_token');
        $input['password'] = bcrypt($input['password']);
        $input['reg_time'] = time();
        $input['head_img'] = base64_img($input['base_img']);
        unset($input['base_img']);
        $status = User::create($input);
        if($status){
            Log::info(session('users.username').'新增用户'.$input['name']);
            return response()->json(array(
                'status' => 200,
                'msg' => '新增成功，即将关闭此页面',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '角色新增失败，请稍后重试',
            ));
        }
    }


    public function edit($id)
    {
        $data = User::find($id)->toArray();
        return view('admin.user_form_edit',compact('data'));
    }


    public function update()
    {
        
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     * 会员数据接口
     */
    public function getList()
    {
        $pageIndex = request()->pageIndex ? request()->pageIndex : 1;  //当前页数
        $pageSize = request()->pageSize ? request()->pageSize : 10;     //每页个数
        $pageStart = $pageIndex == 1 ? 0 : ($pageIndex-1) * $pageSize;  //每页开始的个数
        $sort_field = request()->sort ? request()->sort : 'id';         //排序字段
        $order = request()->order ? request()->order : 'asc';           //排序规则
        $keywords = request()->name ? request()->name : '';       //搜索关键词
        if($keywords == ''){
            $data = User::where('is_admin','!=','1')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get()->toArray();
        }else {
            $data = User::where('is_admin', '!=', '1')->where(function ($query) use ($keywords) {
                $query->where('name', 'like', '%' . $keywords . '%')
                    ->orWhere(function ($query) use ($keywords) {
                        $query->where('email', 'like', '%' . $keywords . '%');
                    });
            })->offset($pageStart)->limit($pageSize)->orderBy($sort_field, $order)->get()->toArray();
        }
        $count = User::where('is_admin','!=','1')->count();
        foreach ($data as $k=>$v){
            $data[$k]['last_login'] = date('Y-m-d H:i:s',$v['last_login']);
        }
        return response()->json(array(
            'rel'  => 'ture',
            'msg'   => '',
            'count' => $count,
            'list'  => $data
        ));
    }


}
