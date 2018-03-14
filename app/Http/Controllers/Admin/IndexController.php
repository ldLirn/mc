<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\model\MenuModel;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $this->put_menu_json();
        return view('admin.index');
    }

    public function main()
    {
        return view('admin.main');
    }


    public function put_menu_json()
    {
        $model = new MenuModel();
        if(session('users.username') == 'admin'){  //超级管理员 拥有所有菜单权限
            $menuAll = $model->orderBy('order','asc')->get()->toArray();
            $menuList = $model->getTree($menuAll);
        }else{
            $userData = User::with('role')->where('name',session('users.username'))->first()->toArray();
            $userPermission = DB::table('permission_role')->select('permission_id')->where('role_id',$userData['role']['0']['id'])->get();
            $permission = array();
            //取得当前用户的菜单id
            foreach ($userPermission as $v){
                $permission[]= $v->permission_id;
            }
            //把当前用户的菜单顶级id和菜单id 合并 并查找出这个数组
            $menuAll = $model->orderBy('order','asc')->get()->toArray();
            $in_menu = array();
            foreach ($menuAll as $m) {
                if (in_array($m['bind_permission'], $permission)) {
                    $in_menu[] = $m['id'];
                    $in_menu[] = $m['pid'];
                }
            }
            $in_menu = array_unique($in_menu);
            $menuData = $model->whereIn('id',$in_menu)->orderBy('order','asc')->get()->toArray();
            $menuList = $model->getTree($menuData);
        }
        $data = $model->to_json($menuList);
        $this->exist($data,session('users.username'));
    }
    public function exist($data,$id)
    {
        $filename = public_path()."/admin/datas/nav".$id.".json";
        file_put_contents($filename,$data);
    }
}
