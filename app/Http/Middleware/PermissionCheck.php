<?php

namespace App\Http\Middleware;

use App\Http\Model\User;
use Closure;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,$permission)
    {
        $user = User::where('name',session('users.username'))->first();
        if (! $user->can($permission)) {
            if($request->ajax()){
                return response()->json(array(
                    'status' => -1,
                    'msg' => '哎哟喂！您没有权限进行此操作！',
                ));
            }else{
                abort(403);
            }

        }
        return $next($request);
    }
}
