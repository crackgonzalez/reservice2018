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

    //Middleware para Administradores
    public function handle($request, Closure $next)
    {
        if(Auth::user()->account_id == 1){
            return $next($request);            
        }else{
            Auth::logout();
            alert()->error('Intentaste acceder a una ruta a la cual no tienes permisos','No Autorizado')->autoclose(5000);
        } 
        return redirect('/');      
    }
}
