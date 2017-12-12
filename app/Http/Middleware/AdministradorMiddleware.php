<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdministradorMiddleware
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
        if(Auth::user()->account_id == 1){
            return $next($request);            
        }else{
            Auth::logout();
        } 
        return redirect('/');      
    }
}
