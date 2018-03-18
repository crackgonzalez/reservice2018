<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Document;
use Exception;
use File;

class DocumentController extends Controller
{
    public function create(){
        return view('empresa.validar.create');
    }

    public function store(Request $requerimiento){
    	$mensajes =[
    		'pdf.required' =>'El archivo es obligatorio',
    		'pdf.mimes' => 'El archivo debe ser de tipo: pdf.',
    		'pdf.max' => 'El archivo no debe pesar mas de 2MB.'
    	];
    	$reglas = [
    		'pdf' => 'required|mimes:pdf|max:2000'
    	];

    	$this->validate($requerimiento,$reglas,$mensajes);

    	if($requerimiento->hasFile('pdf')){
    		try{
    			$archivo = $requerimiento->file('pdf');
	    		$ruta = public_path().'/archivos';
	    		$nombreArchivo = Auth::user()->name.uniqid().$archivo->getClientOriginalName();
	    		$movido = $archivo->move($ruta,$nombreArchivo);

	    		if($movido){
	    			$documento = new Document;
	    			$documento->document = $nombreArchivo;
	    			$documento->company_id = Auth::user()->empresa->id;
	    			$exito = $documento->save();
	    			if($exito){
	    				alert()->success('El archivo fue guardado correctamente','Archivo Guardado')->autoclose(3000);
	    			}else{
	    				alert()->error('El archivo no pudo ser guardado','Ocurrio un Error')->autoclose(3000);
	    			}
	    		}
    		}catch(Exception $e){
    			$borrar = $ruta.'/'.$nombreArchivo;
    			File::delete($borrar);
    			alert()->error('Ya ha subido un documento','Ocurrio un Error')->autoclose(3000);
    		}
	    		
    	}

    	return redirect('empresa/perfil');
    }
}
