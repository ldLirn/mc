<?php

namespace App\Http\Controllers\admin;

use App\Http\model\MenuModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('PermissionCheck:list.menu',['only'=>['index','getApi']]);
        $this->middleware('PermissionCheck:create.menu', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.menu', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.menu', ['only' => ['delete']]);
    }

    public function index(){
        return view('admin.menu.list',compact('data'));
    }
}
