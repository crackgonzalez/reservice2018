<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Commune;
use App\Service;
use App\Category;
use App\Galery;
use App\Region;
use App\User;
use Exception;
use Alert;
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

    //Edita el Perfil Empresa ** separar la edicion de la foto
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

                    $modificadaEmpresa = $empresa->update($requerimiento->only('phone','address','description','commune_id'));
                    $modificadaUsuario = $empresa->usuario->update($requerimiento->only('name','email'));
                    if($modificadaEmpresa && $modificadaUsuario){
                        alert()->success('El perfil fue modificado correctamente','Perfil Modificado')->autoclose(3000);
                    }else{
                        alert()->error('El perfil no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
                    }
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

    public function createService(){
        $categorias = Category::orderBy('category','asc')->get();
        return view('empresa.perfil.createService')->with(compact('categorias'));
    }

    public function storeService(Request $requerimiento){
        $mensajes =[
            'category_id.exists' =>'Debe seleccionar una Categoria',
            'service_id.exists' =>'Debe seleccionar un Servicio',
        ];

        $reglas = [
            'category_id' => 'exists:categories,id',
            'service_id' => 'exists:services,id' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);
        try{
            $empresa = Company::find($requerimiento->input('company'));
            $servicio = $requerimiento->input('service_id');
            $exito = $empresa->servicios()->attach($servicio);
            if(!$exito){
                alert()->success('El servicio fue ingresado correctamente','Servicio Agregado')->autoclose(3000);
            }
        } catch (Exception $e) {
                alert()->warning('El servicio ya se encuentra agregado','Advetencia')->autoclose(3000);
            }
        return redirect('empresa/perfil');
    }

    public function porCategoria($id){
        return Service::where('category_id',$id)->get();
    }

    public function destroyService($id,Request $requerimiento){
        $empresa = Company::find($requerimiento->input('company'));
        $servicio = Service::find($id);
        $exito = $empresa->servicios()->detach($servicio);
        if($exito){
            alert()->success('El servicio fue eliminado correctamente','Servicio Eliminado')->autoclose(3000);
        }
        return redirect('empresa/perfil');
    }

    public function createCommune(){
        $regiones = Region::orderBy('region','asc')->get();
        return view('empresa.perfil.createCommune')->with(compact('regiones'));
    }

    public function storeCommune(Request $requerimiento){
        $mensajes =[
            'region_id.exists' =>'Debe seleccionar una Region',
            'commune_id.exists' =>'Debe seleccionar una Comuna',
        ];

        $reglas = [
            'region_id' => 'exists:regions,id',
            'commune_id' => 'exists:communes,id' 
        ];

        $this->validate($requerimiento,$reglas,$mensajes);
        try{
            $empresa = Company::find($requerimiento->input('company'));
            $comuna = $requerimiento->input('commune_id');
            $exito = $empresa->comunas()->attach($comuna);
            if(!$exito){
                alert()->success('La comuna fue ingresada correctamente','Comuna Agregada')->autoclose(3000);
            }
        } catch (Exception $e) {
                alert()->warning('La comuna ya se encuentra agregada','Advetencia')->autoclose(3000);
            }
        return redirect('empresa/perfil');
    }


    public function porRegion($id){
        return Commune::where('region_id',$id)->get();
    }

    public function destroyCommune($id,Request $requerimiento){
        $empresa = Company::find($requerimiento->input('company'));
        $comuna = Commune::find($id);
        $exito = $empresa->comunas()->detach($comuna);
        if($exito){
            alert()->success('La comuna fue eliminada correctamente','Comuna Eliminada')->autoclose(3000);
        }
        return redirect('empresa/perfil');
    }

    public function createGalery(){
        return view('empresa.perfil.createGalery');
    }

    public function storeGalery(Request $requerimiento){
        $mensajes =[
            'image.required' =>'La imagen es obligatoria',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
        ];

        $reglas = [
            'image' => 'required|mimes:jpg,jpeg,bmp,png',
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){   
            $galeria = new Galery;

            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/galeria';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $galeria->image = $nombreFoto;
                $galeria->company_id = $requerimiento->input('company');
                $exito = $galeria->save();                       
                if($exito){
                    alert()->success('La imagen fue agregada correctamente','Imagen Agregada')->autoclose(3000);
                }
            }else{
                alert()->error('La imagen no pudo ser agregada','Ocurrio un Error')->autoclose(3000);
            }       
            return redirect('empresa/perfil');
        }

    }

    public function destroyGalery($id,Request $requerimiento){
        $galeria = Galery::find($id);
        $exito = $galeria->delete();
        if($exito){
            $ruta = public_path().'/imagenes/galeria';
            $imagenAnterior = $ruta.'/'.$galeria->image;
            File::delete($imagenAnterior);
            alert()->success('La imagen fue eliminada correctamente','Imagen Eliminada')->autoclose(3000);
        }
        return redirect('empresa/perfil');
    }
}

