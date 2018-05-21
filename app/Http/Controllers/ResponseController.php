<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Response;
use Auth;

class ResponseController extends Controller
{
    public function responderPresupuesto(){
    	  return view('empresa.presupuesto.edit');
    }

    public function guardarPresupuesto(Request $request,$id){
    	//falta la validacion
    	//falta try catch y en base de datos defir como unique
    	$mensajes =[];
    	$reglas = [];
    	$this->validate($request,$reglas,$mensajes);

    	$presupuesto = Response::find($id);
    	$presupuesto->state_company = $request->input('state_company');
    	$presupuesto->price = $request->input('price');
    	$presupuesto->description = $request->input('description');
    	$exito = $presupuesto->save();
    	if ($exito) {
    		alert()->success('El presupuesto se envio correctamente','Presupuesto Enviado')->autoclose(3000);
    	}
    	return redirect('empresa/presupuesto');

    }
}
