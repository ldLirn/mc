<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\ConfigModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware('PermissionCheck:list.config',['only'=>['index','getList']]);
        $this->middleware('PermissionCheck:create.config', ['only' => ['create','store']]);
        $this->middleware('PermissionCheck:edit.config', ['only' => ['edit', 'update']]);
        $this->middleware('PermissionCheck:delete.config', ['only' => ['destroy']]);
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

    /**
     * @param Requests\ConfigCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加操作
     */
    public function store(Requests\ConfigCreateRequest $request)
    {
        $input = $request->except('_token');
        $status = ConfigModel::create($input);
        if($status){
            Log::info(session('users.admin_name').'添加网站配置'.$input['config_title']);
            return response()->json(array(
                'status' => 200,
                'msg' => '新增成功',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '配置信息新增失败，请稍后重试',
            ));
        }
    }

    public function destroy()
    {
        $id = request()->id;
        $name = request()->name;
        $status = ConfigModel::destroy($id);
        if($status){
            Log::info(session('users.admin_name').'删除网站配置['.$name.']');
            $this->putFile();
            return response()->json(array(
                'status' => 200,
                'msg' => '配置项删除成功!',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '配置项删除失败，请稍后重试!',
            ));
        }
    }

    public function edit($id)
    {
        $data = ConfigModel::find($id);
        return view('admin.config_form_edit',compact('data'));
    }

    /**
     * @param Requests\ConfigEditRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * 更改配置项操作
     */
    public function update(Requests\ConfigEditRequest $request,$id)
    {
        $input = $request->except('_token','_method','id');
        $status = ConfigModel::where('id',$id)->update($input);
        if($status){
            Log::info(session('users.admin_name').'修改网站配置'.$input['config_title']);
            $this->putFile();
            return response()->json(array(
                'status' => 200,
                'msg' => '配置项更新成功!',
            ));
        }else{
            return response()->json(array(
                'status' => -1,
                'msg' => '配置项更新失败，请稍后重试!',
            ));
        }
    }

    public function updateConfig()
    {
        $input = Input::all();
        dd($input);
        foreach($input['id'] as $k=>$v){
            ConfigModel::where('id',$v)->update(['config_content'=>$input['config_content'][$k]]);
        }
        $this->putFile();
        Log::info(session('users.admin_name').'修改网站配置值');
        return back()->with('msg','配置项更新成功！');
    }
    //将网站配置信息写入文件
    protected function putFile()
    {
        $config = ConfigModel::pluck('config_content','config_name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }
}
