<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Role as BicanRole;
class Role extends BicanRole
{
    protected $table = 'roles';

    protected $fillable = ['name','slug','description','level'];

    public function permission()
    {
        return $this->belongsToMany('App\Http\Model\Permission','permission_role','role_id','permission_id')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\Http\Model\User','role_user','role_id','user_id')->withTimestamps();
    }
}
