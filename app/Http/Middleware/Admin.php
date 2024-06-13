<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$guard = null)
    {
        //if ( Auth::guard($guard)->check() ) {
        if (Session::get('admin_token')) {

            return $next($request);
        }

        return redirect(config('app.admin_login_url'));
    }
}
