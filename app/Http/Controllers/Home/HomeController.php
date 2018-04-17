<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Common\BaseController;




/**
 * Class HomeController
 * @package App\Http\Controllers\Home
 * 前台  主要功能
 */
class HomeController extends BaseController
{

    /**
     * Show the application dashboard.
     *  首页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('home.index');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 数据接口
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
            $data = ConfigModel::orderBy('config_order','desc')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get();
        }else{
            $data = ConfigModel::where('config_title','like','%'.$keywords.'%')->orWhere('config_name','like','%'.$keywords.'%')->offset($pageStart)->limit($pageSize)->orderBy($sort_field,$order)->get();
        }
        $count = ConfigModel::count();
        foreach ($data as $k=>$v){
            switch ($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" name="config_content[]" placeholder="请输入网站标题" class="layui-input" value="'.$v->config_content.'"/>';
                    break;
                case 'radio':
                    $field_arr = explode(',',$v->field_value);  //单选字段的切割
                    $str = '';
                    foreach($field_arr as $a=>$s){
                        $arr = explode('|',$s);
                        $check ='';
                        if($v->config_content == $arr[0]){
                            $check = ' checked ';
                        }
                        $str .= '<input type="radio" name="config_content[]" title="'.$arr[1].'" value="'.$arr[0].'" '.$check.'/>'.$arr[1].'    ';
                    }
                    $data[$k]->_html = $str;
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea name="config_content[]" placeholder="请输入内容" class="layui-textarea">'.$v->config_content.'</textarea>';
                    break;
            }
        }
        return response()->json(array(
            'rel'  => 'ture',
            'msg'   => '',
            'count' => $count,
            'list'  => $data
        ));
    }
}
