<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galery;
use App\Company;
use Exception;
use Alert;
use File;

class GaleryController extends Controller
{
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
