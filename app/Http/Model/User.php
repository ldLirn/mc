<?php
/**
 * Created by PhpStorm.
 * User: lirn
 * Date: 2017/11/17
 * Time: 9:18
 */
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Auth\Passwords\CanResetPassword;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable,CanResetPassword , HasRoleAndPermission;

    protected $guarded=[];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function permission()
    {
        return $this->belongsToMany('App\Http\Model\Permission','permission_user','user_id','permission_id')->withTimestamps();
    }


    public function role()
    {
        return $this->belongsToMany('App\Http\Model\Role','role_user','user_id','role_id')->withTimestamps();
    }


    public function getPermission()
    {
        return $this->belongsToMany('App\Http\Model\Permission','permission_user','user_id','permission_id')->withTimestamps();
    }
    
    //得到用户的id
    public function getUserId($user_name)
    {
        return $this->where('name','like','%'.$user_name.'%')->where('is_admin','0')->lists('id');
    }
}