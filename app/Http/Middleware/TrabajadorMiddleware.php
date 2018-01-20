<?php

namespace App\Http\Middleware;

use Closure;

class TrabajadorMiddleware
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
        if(Auth::user()->account_id == 2){
            return $next($request);            
        }else{
            Auth::logout();
            alert()->error('Intentaste acceder a una ruta a la cual no tienes permisos','No Autorizado')->autoclose(5000);
        } 
        return redirect('/');
    }
}
