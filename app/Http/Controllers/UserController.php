<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RUT;
use Exception;

class UserController extends Controller
{

    public function create(){
        return view('empresa.trabajador.create');
    }

    public function store(Request $requerimiento){

        $mensajes =[
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',
            'email.unique' =>'El email ya ha sido registrado en la base de datos',
            'password.required'=>'El campo contraseña es obligatorio',
            'password.min'=>'El campo nombre debe tener al menos 6 caracteres',
            'password.confirmed'=>'La contraseña ingresada no coincide con su confirmacion',
            'account_id.in'=>'Debe seleccionar un tipo de cuenta (Trabajador)',
            'rut.required' =>'El campo rut es obligatorio',  
            'rut.unique' =>'El rut ya ha sido registrado en la base de datos',
            'rut.min' =>'El campo rut debe tener al menos 8 caracteres',
            'rut.max' =>'El campo rut debe tener como maximo 12 caracteres', 
            
        ];

        $reglas = [
            'name' => 'required|string|min:2|max:30|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'account_id' => 'required|in:2',
            'rut' => ['required','unique:users','min:8','max:12',
                        function($attribute, $value, $fail){
                            try{
                                if(!RUT::check($value)){
                                    $fail('El rut es invalido');
                                }
                            }catch(Exception $e){
                                $fail('El rut es invalido');
                            }
                        }],           
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $usuario = new User();
        $usuario->name = $requerimiento->input('name');
        $usuario->rut = $requerimiento->input('rut');
        $usuario->email = $requerimiento->input('email');
        $usuario->password = bcrypt($requerimiento->input('password'));
        $usuario->account_id = $requerimiento->input('account_id'); 
        $exito = $usuario->save();
        if($exito){
            alert()->success('El trabajador fue ingresado correctamente','Trabajador Registrado')->autoclose(3000);
        }else{
            alert()->error('El trabajador no pudo ser ingresado','Ocurrio un Error')->autoclose(3000);
        }
        return redirect('empresa/trabajador');
    }

    //Envia a Formulario para Editar el Estado de la Cuenta por Empresa
    public function editarEstadoEmpresa(User $usuario){
        return view('administrador.empresas.edit')->with(compact('usuario'));
    }

    //Edita el Estado de la Cuenta de la Empresa
    public function actualizarEstadoEmpresa(Request $requerimiento, User $usuario){  
    	$mensajes =[
            'state.boolean' =>'Debe seleccionar una opcion', 
        ];

        $reglas = [
            'state' => 'boolean' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $modificada = $usuario->update($requerimiento->only('state'));
        if($modificada){
            alert()->success('La cuenta fue modificada correctamente','Cuenta Modificada')->autoclose(3000);
        }else{
            alert()->error('La cuenta no pudo ser modificada','Ocurrio un Error')->autoclose(3000);
        }

    	return redirect('administrador/empresas');
    }

    public function editar(User $usuario){
        return view('empresa.trabajador.edit')->with(compact('usuario'));
    }


    public function actualizar(Request $requerimiento, User $usuario){  
        $mensajes =[
            'state.boolean' =>'Debe seleccionar una opcion', 
        ];

        $reglas = [
            'state' => 'boolean' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $modificada = $usuario->update($requerimiento->only('state'));
        if($modificada){
            alert()->success('La cuenta fue modificada correctamente','Cuenta Modificada')->autoclose(3000);
        }else{
            alert()->error('La cuenta no pudo ser modificada','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('empresa/trabajador');
    }
}
