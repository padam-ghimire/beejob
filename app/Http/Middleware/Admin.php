<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $role = Auth()->user()->roles()->pluck('type');
        if($role->contains('admin')){

            return $next($request);
        }else{

            return redirect( route('login'));
        }

    }
}
