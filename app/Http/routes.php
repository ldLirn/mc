<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
DB::enableQueryLog();
Route::pattern('id', '[0-9]+'); //全局设置id只能是数字
//后台登录路由组
Route::group(['middleware' => ['web'],'as' => 'admin/','namespace' => 'Admin','prefix' => 'admin'], function () {
    Route::get('login', function (){
        return view('admin.login');
    });           //登录页面
    Route::post('post_login', 'LoginController@login');      //验证登录
    Route::get('out', 'LoginController@out');           //后台退出路由
});
//后台路由组
Route::group(['middleware' => ['web','admin.login'],'as' => 'admin/','namespace' => 'Admin','prefix' => 'admin'], function () {
    Route::get('index', 'IndexController@index');           //后台首页主框架
    Route::get('index/main', 'IndexController@main');
    Route::get('power/list','PowerController@index');
    Route::get('power/list/edit/{id}','PowerController@edit');
    Route::post('power/list/update','PowerController@update');
    Route::get('power/list/add','PowerController@create');
    Route::post('power/list/store','PowerController@store');
    Route::post('power/list/delete','PowerController@delete');
    Route::get('api/admin_list','PowerController@getApi');
    Route::get('power/role','RoleController@index');
    Route::get('api/admin_role','RoleController@getRoleApi');
    Route::get('power/role/add','RoleController@create');
    Route::post('power/role/store','RoleController@store');
    Route::get('power/role/edit/{id}','RoleController@edit');
    Route::post('power/role/update','RoleController@update');
    Route::post('power/role/delete','RoleController@delete');
    Route::get('menu/list','MenuController@index');
    Route::get('config',function(){
        return view('admin.config_list');
    });
    Route::get('config/list','ConfigController@getList');
    Route::get('config/add',function (){
        return view('admin.config_form_create');
    });
    Route::post('config/store','ConfigController@store');
    Route::get('config/edit/{id}','ConfigController@edit');
    Route::post('config/update','ConfigController@update');
    Route::delete('config/delete/{id}','ConfigController@destroy');
    Route::post('config/update/{id}','ConfigController@update');
    Route::post('config/updateConfig','ConfigController@updateConfig');

    //Route::resource('user','UserController');
    Route::get('user',function (){
        return view('admin.user_list');
    });
    Route::get('users/list','UserController@getList');
    Route::get('user/add','UserController@create');
    Route::post('user/store','UserController@store');
    Route::get('user/edit/{id}','UserController@edit');
    Route::put('user/update/{id}','UserController@update');
});

Route::get('auth/geetest','Auth\AuthController@getGeetest');