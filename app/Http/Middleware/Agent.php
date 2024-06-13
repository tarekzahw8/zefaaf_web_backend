<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class Agent
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
        if (Session::get('agent_token')) {

            return $next($request);
        }

        return redirect(url('/').'/agent_dashboard/login');
    }
}
