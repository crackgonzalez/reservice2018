<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\Region;
use File;
use Exception;
use Alert;

class CommuneController extends Controller
{
    //Lista las Comunas por Orden Ascendente y Paginado en 12 Registros
    public function index(){
    	$comunas = Commune::orderBy('commune','asc')->paginate(12);
    	return view('administrador.comunas.index')->with(compact('comunas'));
    }

    //Envia a Formulario para Crear una Comuna y Carga las Regiones
    public function create(){
    	$regiones = Region::orderBy('region','asc')->get();
    	return view('administrador.comunas.create')->with(compact('regiones'));
    }

    //Crea una Comuna
    public function store(Request $requerimiento){

    	$mensajes =[
            'commune.required' =>'El campo comuna es obligatorio',
            'commune.min' =>'El campo comuna debe tener al menos 2 caracteres',
            'commune.max' =>'El campo comuna debe tener como maximo 60 caracteres',            
            'commune.regex' => 'El campo categoria solo acepta cadenas de texto',
            'commune.unique' => 'La comuna ya ha sido registrada en la base de datos',
            'image.required' =>'La imagen es obligatoria',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'region_id.exists' =>'Debe seleccionar una categoria',
        ];

        $reglas = [
            'commune' => 'required|min:2|max:60|unique:communes|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'required|mimes:jpg,jpeg,bmp,png',
            'region_id' => 'exists:regions,id'             
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $comuna = Commune::create($requerimiento->only('commune','region_id'));

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/comunas';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $comuna->image = $nombreFoto;
                $comuna->save();
                alert()->success('La comuna fue ingresada correctamente','Comuna Agregada')->autoclose(3000);
            }else{
                alert()->error('La comuna no pudo ser ingresada','Ocurrio un Error')->autoclose(3000);
            }
        }
        return redirect('administrador/comunas');
    }

    //Envia a Formulario para Editar una Comuna y Carga las Regiones
    public function edit(Commune $comuna){
        $regiones = Region::orderBy('region','asc')->get();
        return view('administrador.comunas.edit')->with(compact('comuna','regiones'));
    }

    //Edita la Comuna
    public function update(Request $requerimiento, Commune $comuna){  
        
        $mensajes =[
            'commune.required' =>'El campo servicio es obligatorio',
            'commune.min' =>'El campo servicio debe tener al menos 2 caracteres',
            'commune.max' =>'El campo servicio debe tener como maximo 60 caracteres',
            'commune.regex' => 'El campo servicio solo acepta cadenas de texto y valores numericos',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.',
            'regions_id.exists' =>'Debe seleccionar una region',
        ];

        $reglas = [
            'commune' => 'required|min:2|max:60|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'mimes:jpg,jpeg,bmp,png',
            'region_id' => 'exists:regions,id'     
        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/comunas';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $imagenAnterior = $ruta.'/'.$comuna->image;
                $comuna->image = $nombreFoto;
                $exito = $comuna->save();                        
                if($exito){
                    File::delete($imagenAnterior);
                    alert()->success('La comuna fue modificada correctamente','Comuna Modificada')->autoclose(3000);
                }
            }
        }else{
            $modificada = $comuna->update($requerimiento->only('commune','region_id'));
            if($modificada){
                alert()->success('La comuna fue modificada correctamente','Comuna Modificada')->autoclose(3000);
            }else{
                alert()->error('la comuna no pudo ser modificado','Ocurrio un Error')->autoclose(3000);
            }
        }            
        return redirect('administrador/comunas');
    }

    //Elimina una Comuna
    public function destroy($id){

        $comuna = Commune::find($id);
        $ruta = public_path().'/imagenes/comunas';
        $rutaImagen = $ruta.'/'.$comuna->image;
        $exito = $comuna->delete();
        if($exito){
            File::delete($rutaImagen);
            alert()->success('El comuna fue eliminada correctamente','Comuna Eliminada')->autoclose(3000);
        }       
        return redirect('administrador/comunas');
    }
}
