<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Company;
use App\Client;
use File;
use Exception;
use Auth;
use Alert;
use DB;

class EmployeController extends Controller
{
    public function index(){
    	$empresas = Company::all();
    	return view('empresa.trabajador.index')->with(compact('empresas'));
    }

    public function inicio(){
        $trabajador = Auth::user()->trabajador;
        $trabajadores = Employe::find($trabajador);
        $contador = DB::table('client_employe')->join('employes','employes.id','=','client_employe.employe_id')
                    ->where('client_employe.employe_id','=',$trabajador->id)
                    ->avg('client_employe.score');

    	return view('trabajador.perfil.index')->with(compact('trabajadores','contador'));
    }

    public function edit(Employe $trabajador){
        $trabajador = Employe::find($trabajador->id);
        return view('trabajador.perfil.edit')->with(compact('trabajador'));
    }

    public function update(Request $requerimiento, Employe $trabajador){
        $mensajes =[
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'phone.required' =>'El campo telefono es obligatorio',
            'phone.numeric' =>'El telefono no cumple con el formato solicitado (Ej:998773251)',
            'phone.digits_between' => 'El numero de telefono debe estar en el rango de 8 a 11 digitos',
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',            
        ];

        $reglas = [
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'phone' => 'required|numeric|digits_between:8,11',
            'name' => 'required|string|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50',            
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $borrar = $trabajador->image;
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/perfil';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$trabajador->image;
                $trabajador->image = $nombreFoto;
                $exito = $trabajador->save();                        
                if($exito){
                    if($borrar != 'fotoperfil.jpg'){
                        File::delete($imagenAnterior);
                    }

                    $modificadaTrabajador = $trabajador->update($requerimiento->only('phone'));
                    $modificadaUsuario = $trabajador->usuario->update($requerimiento->only('name','email'));
                    if($modificadaTrabajador && $modificadaUsuario){
                        alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                    }else{
                        alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
                    }
                }
            }
        }else{
            $modificadaTrabajador = $trabajador->update($requerimiento->only('phone'));
            $modificadaUsuario = $trabajador->usuario->update($requerimiento->only('name','email'));
            if($modificadaTrabajador && $modificadaUsuario){
                alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
            }else{
                alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }    

        return redirect('trabajador/perfil');
    }

    //Elimina un Trabajador
    public function destroy($id){
    	try{
            $trabajador = Employe::find($id);
            $borrar = $trabajador->image;
            $ruta = public_path().'/imagenes/perfil';
            $imagenAnterior = $ruta.'/'.$trabajador->image;           
    		$exito = $trabajador->delete();
    		if($exito){
                if($borrar != 'fotoperfil.jpg'){
                    File::delete($imagenAnterior);
                }
    			alert()->success('La trabajador fue eliminado correctamente','Trabajador Eliminado')->autoclose(3000);
    		}else{
                alert()->error('El trabajador no pudo ser eliminado','Ocurrio un Error')->autoclose(3000);
            }
        }catch(Exception $e){
            alert()->warning('El trabajador se encuentra asociado a un servicio','No se Puede Eliminar')->autoclose(3000);
        }
        return redirect('empresa/trabajador');
        
    }
    
}
