<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function edit(User $usuario){
        return view('administrador.empresas.edit')->with(compact('usuario'));
    }

    public function update(Request $requerimiento, User $usuario){  
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
}
