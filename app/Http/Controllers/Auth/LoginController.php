<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

        ];

        $reglas = [
             'email' => 'required|string|email|max:50',
        ];

        $this->validate(request(),$reglas,$mensajes);
    }

    //redirecion de prueba
    protected function redirectTo()
    {
        if(\Auth::user()->account_id == 1){
            return '/administrador/categorias';    
        }else{
            return '/';
        }
        
    }

}
