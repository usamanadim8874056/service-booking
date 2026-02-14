<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path=$request->path();
      

        if(( $path == "login") && Session::get('user_id')){
            return redirect('dashboard');
        }
        else if(($path != 'login') && (!Session::get('user_id'))){
            return redirect('login');
        }
        // else if(($path == 'signup') && (Session::get('user_id'))){
        //     return redirect('dashboard');
        // }
        // else if(($path == 'provider-signup') && (Session::get('user_id'))){
        //     return redirect('dashboard');
        // }
       return $next($request);
    }
}
