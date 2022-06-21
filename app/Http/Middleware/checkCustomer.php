<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Auth;
use Session;

class checkCustomer
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
        $checkLogin = Session::get('customerId');
        if (!$checkLogin) {
            return redirect('/login_checkout');
        }else{
             return $next($request);
        }      
    }
}
