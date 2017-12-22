<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use File;

class CompanyController extends Controller
{
	//
    public function index(){
    	$empresas = Company::all();
    	return view('empresa.perfil.index')->with(compact('empresas'));
    }

    //Envia a Formulario para Editar una Categoria
    public function edit(Company $empresa){
    	$usuario = User::find($empresa->user_id);
        return view('empresa.perfil.edit')->with(compact('empresa','usuario'));
    }

    //Edita el Servicio
    public function update(Request $requerimiento, Company $empresa){  
        
        $mensajes =[
            
        ];

        $reglas = [
               
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/perfil';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$empresa->image;
                $empresa->image = $nombreFoto;
                $exito = $empresa->save();                        
                if($exito){
                	if($empresa->image != 'fotoperfil.jpg'){
                		File::delete($imagenAnterior);
                	}                    
                    alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                }
            }
        }else{
            $modificadaEmpresa = $empresa->update($requerimiento->only('phone','address'));
            $modificadaUsuario = $empresa->usuario->update($requerimiento->only('name','email'));
            if($modificadaEmpresa && $modificadaUsuario){
                alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
            }else{
                alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }            
        return redirect('empresa/perfil');
    }
}



// public function giveCredits($id)
// {
//     $report = Report::where('id', $id)->first();
//     $report->credits += Input::get('credits');

//     // if the report has a user, update it
//     if ($report->user) {
//         $report->user->credits += Input::get('credits');
//         $report->user->save();
//     }

//     $report->save();
//     return redirect()->back();
// }