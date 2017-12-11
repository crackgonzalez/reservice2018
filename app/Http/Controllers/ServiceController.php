<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;
use App\Category;

class ServiceController extends Controller
{
    //
    public function index(){
    	$servicios = Service::orderBy('service','asc')->paginate(12);
    	return view('administrador.servicios.index')->with(compact('servicios'));
    }

    public function create(){
    	$categorias = Category::orderBy('category','asc')->get();
    	return view('administrador.servicios.create')->with(compact('categorias'));
    }

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
    
}
