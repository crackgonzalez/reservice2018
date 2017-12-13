<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function index(){
    	$regiones = Region::orderBy('region','asc')->paginate(12);
    	return view('administrador.regiones.index')->with(compact('regiones'));
    }

    public function create(){
    	return view('administrador.regiones.create');
    }

    public function store(Request $requerimiento){  

        $mensajes =[
            'region.required' =>'El campo region es obligatorio',
            'region.min' =>'El campo region debe tener al menos 5 caracteres',
            'region.max' =>'El campo region debe tener como maximo 60 caracteres',
            'region.unique' => 'La region ya ha sido registrada en la base de datos',
            'region.regex' => 'El campo region solo acepta cadenas de texto y valores numericos',
            'image.required' =>'La imagen es obligatoria',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.'
        ];

        $reglas = [
            'region' => 'required|min:5|max:60|unique:regions|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'required|mimes:jpg,jpeg,bmp,png'    
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $region = Region::create($requerimiento->only('region'));

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/regiones';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $region->image = $nombreFoto;
                $region->save();
                alert()->success('La region fue ingresada correctamente','Region Agregada')->autoclose(3000);
            }else{
                alert()->error('La region no pudo ser ingresada','Ocurrio un Error')->autoclose(3000);
            }
        }
        return redirect('administrador/regiones');
    }
}
