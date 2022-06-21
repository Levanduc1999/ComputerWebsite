<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Auth;
use Session;

class checkAdmin
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
        // $checkLogin = Auth::user()role();
        // dd(Auth::user()->hasanyrole(['admin','distributor']));
        if (Auth::user()->hasanyrole(['admin','distributor'])) {
            return $next($request);
        }
        return redirect('/admin_home');
    }
}
