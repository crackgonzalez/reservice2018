<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;
use App\Category;
use App\Company;
use File;
use Exception;
use Alert;

class ServiceController extends Controller
{
    //Lista los Servicios por Orden Ascendente y Paginado en 12 Registros
    public function index(){
    	$servicios = Service::orderBy('service','asc')->paginate(12);
    	return view('administrador.servicios.index')->with(compact('servicios'));
    }

    //Envia a Formulario para Crear un Servicio y Carga las Categorias
    public function create(){
    	$categorias = Category::orderBy('category','asc')->get();
    	return view('administrador.servicios.create')->with(compact('categorias'));
    }

    //Crea un Servicio
    public function store(Request $requerimiento){

    	$mensajes =[
            'service.required' =>'El campo servicio es obligatorio',
            'image.required' =>'La imagen es obligatoria',
            'service.min' =>'El campo service debe tener al menos 2 caracteres',
            'service.max' =>'El campo servicio debe tener como maximo 30 caracteres',            
            'service.regex' => 'El campo categoria solo acepta cadenas de texto y valores numericos',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'category_id.exists' =>'Debe seleccionar una categoria',
        ];

        $reglas = [
            'service' => 'required|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'required|mimes:jpg,jpeg,bmp,png',
            'category_id' => 'exists:categories,id'             
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $servicio = Service::create($requerimiento->only('service','category_id'));

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/servicios';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $servicio->image = $nombreFoto;
                $servicio->save();
                alert()->success('El servicio fue ingresado correctamente','Servicio Agregado')->autoclose(3000);
            }else{
                alert()->error('El servicio no pudo ser ingresado','Ocurrio un Error')->autoclose(3000);
            }
        }
        return redirect('administrador/servicios');
    }

    //Envia a Formulario para Editar un Servicio y Carga las Categorias
    public function edit(Service $servicio){
        $categorias = Category::orderBy('category','asc')->get();
        return view('administrador.servicios.edit')->with(compact('servicio','categorias'));
    }

    //Edita el Servicio
    public function update(Request $requerimiento, Service $servicio){  
        
        $mensajes =[
            'service.required' =>'El campo servicio es obligatorio',
            'service.min' =>'El campo servicio debe tener al menos 2 caracteres',
            'service.max' =>'El campo servicio debe tener como maximo 30 caracteres',
            'service.regex' => 'El campo servicio solo acepta cadenas de texto y valores numericos',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'category_id.exists' =>'Debe seleccionar una categoria',
        ];

        $reglas = [
            'service' => 'required|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'category_id' => 'exists:categories,id'     
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/servicios';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$servicio->image;
                $servicio->image = $nombreFoto;
                $exito = $servicio->save();                        
                if($exito){
                    File::delete($imagenAnterior);
                    alert()->success('El servicio fue modificado correctamente','Servicio Modificado')->autoclose(3000);
                }
            }
        }else{
            $modificada = $servicio->update($requerimiento->only('service','category_id'));
            if($modificada){
                alert()->success('El servicio fue modificado correctamente','Servicio Modificado')->autoclose(3000);
            }else{
                alert()->error('El servicio no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }            
        return redirect('administrador/servicios');
    }

    //Elimina el Servicio
    public function destroy($id){

        $servicio = Service::find($id);
        $ruta = public_path().'/imagenes/servicios';
        $rutaImagen = $ruta.'/'.$servicio->image;
        $exito = $servicio->delete();
        if($exito){
            File::delete($rutaImagen);
            alert()->success('El servicio fue eliminado correctamente','Servicio Eliminado')->autoclose(3000);
        }       
        return redirect('administrador/servicios');
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
    
}
