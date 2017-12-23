<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Commune;
use App\User;
use File;

class CompanyController extends Controller
{
	//
    public function index(){
    	$empresas = Company::all();
    	return view('empresa.perfil.index')->with(compact('empresas'));
    }

    //
    public function edit(Company $empresa){
    	$usuario = User::find($empresa->user_id);
        $comunas = Commune::orderBy('commune','asc')->get();
        return view('empresa.perfil.edit')->with(compact('empresa','usuario','comunas'));
    }

    //Edita el Perfil Empresa
    public function update(Request $requerimiento, Company $empresa){  
        
        $mensajes =[
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'phone.required' =>'El campo telefono es obligatorio',
            'phone.numeric' =>'El telefono no cumple con el formato solicitado (Ej:998773251)',
            'phone.digits_between' => 'El numero de telefono debe estar en el rango de 8 a 11 digitos',
            'address.required' =>'El campo direccion es obligatorio',
            'address.regex' => 'El campo description solo acepta cadenas de texto y valores numericos',
            'description.required' =>'El campo descripcion es obligatorio',
            'description.min' =>'El campo descripcion debe tener al menos 10 caracteres',
            'description.max' =>'El campo descripcion debe tener como maximo 180 caracteres',
            'description.regex' => 'El campo description solo acepta cadenas de texto y valores numericos',
            'name.required' =>'El campo nombre es obligatorio',
            'name.min' =>'El campo nombre debe tener al menos 2 caracteres',
            'name.max' =>'El campo nombre debe tener como maximo 30 caracteres',
            'name.regex' => 'El campo nombre solo acepta cadenas de texto y valores numericos',
            'email.required' =>'El campo email es obligatorio',
            'email.max'=>'El campo email debe tener como maximo 50 caracteres',
            'commune_id.exists' =>'Debe seleccionar una comuna',
        ];

        $reglas = [
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'phone' => 'required|numeric|digits_between:8,11',
            'address' => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ#])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ#]*)*)+$/',
            'description' => 'required|min:10|max:180|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ!¡¿?.,]*)*)+$/',
            'name' => 'required|string|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'email' => 'required|string|email|max:50',
            'commune_id' => 'exists:communes,id' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $borrar = $empresa->image;
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/perfil';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$empresa->image;
                $empresa->image = $nombreFoto;
                $exito = $empresa->save();                        
                if($exito){
                	if($borrar != 'fotoperfil.jpg'){
                		File::delete($imagenAnterior);
                	}                    
                    alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                }
            }
        }else{
            $modificadaEmpresa = $empresa->update($requerimiento->only('phone','address','description','commune_id'));
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
