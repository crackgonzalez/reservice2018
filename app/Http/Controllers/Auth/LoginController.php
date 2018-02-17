<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function validateLogin()
    {
        $mensajes = [
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',
            'password.required'=>'El campo contraseña es obligatorio',
        ];

        $reglas = [
             'email' => 'required|string|email|max:50',
             'password' => 'required',
        ];

        $this->validate(request(),$reglas,$mensajes);
    }

    //Redireciona segun el usuario logeado
    protected function redirectTo()
    {
        if(Auth::user()->state == true){
            if(Auth::user()->account_id == 1){
                return '/administrador/categorias';    
            }elseif (Auth::user()->account_id == 2) {
                return 'trabajador/perfil'; 
            }elseif (Auth::user()->account_id == 3) {
                return 'empresa/perfil'; 
            }elseif(Auth::user()->account_id == 4){
                return 'cliente/perfil'; 
            }else{
                Auth::logout();
                return '/';
            }
        }else{
            alert()->error(' Tu Cuenta esta Desactivada',Auth::user()->name)->autoclose(5000);
            Auth::logout();
            return '/';
        }
    }

}
