<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use Exception;
use File;
use Alert;

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
            'region.regex' => 'El campo region solo acepta cadenas de texto',
            'image.required' =>'La imagen es obligatoria',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.'
        ];

        $reglas = [
            'region' => 'required|min:5|max:60|unique:regions|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
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

    public function edit(Region $region){
        return view('administrador.regiones.edit')->with(compact('region'));
    }

    public function update(Request $requerimiento, Region $region){  
        
        $mensajes =[
            'region.required' =>'El campo region es obligatorio',
            'region.min' =>'El campo region debe tener al menos 5 caracteres',
            'region.max' =>'El campo region debe tener como maximo 60 caracteres',
            'region.regex' => 'El campo region solo acepta cadenas de texto',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.'
        ];

        $reglas = [
            'region' => 'required|min:5|max:60|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'mimes:jpg,jpeg,bmp,png'       
        ];

        $this->validate($requerimiento,$reglas,$mensajes);
            try {

                if($requerimiento->hasFile('image')){
                    $foto = $requerimiento->file('image');
                    $ruta = public_path().'/imagenes/regiones';
                    $nombreFoto = uniqid().$foto->getClientOriginalName();
                    $movido = $foto->move($ruta,$nombreFoto);

                    if($movido){
                        $imagenAnterior = $ruta.'/'.$region->image;
                        $region->image = $nombreFoto;
                        $exito = $region->save();                        
                        if($exito){
                            File::delete($imagenAnterior);
                            alert()->success('La region fue modificada correctamente','Region Modificada')->autoclose(3000);
                        }
                    }
                }else{
                    $modificada = $region ->update($requerimiento->only('category'));
                    if($modificada){
                        alert()->success('La region fue modificada correctamente','Region Modificada')->autoclose(3000);
                    }else{
                        alert()->error('La region no pudo ser modificada','Ocurrio un Error')->autoclose(3000);
                    }
                }
            } catch (Exception $e) {
                alert()->warning('La region ya se encuentra registrada','Advetencia')->autoclose(3000);
            }
        return redirect('administrador/regiones');
    }

    public function destroy($id){
        try {
            $region = Region::find($id);
            $ruta = public_path().'/imagenes/regiones';
            $rutaImagen = $ruta.'/'.$region->image;
            $exito = $region->delete();
            if($exito){
                File::delete($rutaImagen);
                alert()->success('La region fue eliminada correctamente','Region Eliminada')->autoclose(3000);
            }
        } catch (Exception $e) {
            alert()->warning('La region se encuentra asociada a una comuna','No se Puede Eliminar')->autoclose(3000);
        }        
        return redirect('administrador/regiones');
    }
}
