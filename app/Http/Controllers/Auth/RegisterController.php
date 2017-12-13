<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Account;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mensajes =[
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',
            'email.unique' =>'El email ya ha sido registrado en la base de datos',
            'password.required'=>'El campo contraseña es obligatorio',
            'password.confirmed'=>'La contraseña ingresada no coincide con su confirmacion',
            'password.min'=>'El campo nombre debe tener al menos 6 caracteres',
            'address.required' => 'El campo direccion es obligatorio',
            'address.min' =>'El campo direccion debe tener al menos 5 caracteres',
            'address.max' =>'El campo direccion debe tener como maximo 100 caracteres',
            'address.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'account_id.in'=>'Debe seleccionar un tipo de cuenta (Empresa o Cliente)',
         
        ];

        return Validator::make($data, [
            'name' => 'required|string|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'account_id' => 'required|in:3,4',
        ],$mensajes);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'account_id' => $data['account_id'],
        ]);
    }

    //Metodo sobreescrito para inyectar los tipos cuentas a la vista.
    public function showRegistrationForm()
    {
        $cuentas = Account::all()->where('id','>',2);
        return view('auth.register')->with(compact('cuentas'));;
    }
}
