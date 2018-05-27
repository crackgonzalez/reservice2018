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
    	//falta try catch y en base de datos defir como unique
    	$mensajes =[
            'state_company.between' =>'Debe seleccionar una opcion',
            'description.required' => 'El campo respuesta es obligatorio',
        ];
    	$reglas = [
            'state_company' => 'between:1,2',
            'description' => 'required',
        ];
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

    public function presupuesto($id){
        $respuesta = Response::find($id);
        return view('cliente.presupuesto.confirmacion')->with(compact('respuesta'));
    }

    public function confirmacion(Request $request,$id){
        $mensajes =[
            'state_client.between' =>'Debe seleccionar una opcion',
        ];
        $reglas = [
            'state_client' => 'between:1,2',
        ];
        $this->validate($request,$reglas,$mensajes);

        $respuesta = Response::find($id);
        $respuesta->state_client = $request->state_client;

        $exito = $respuesta->update();
        if($exito){
            alert()->success('El Presupuesto se respondio correctamente','Se ha Respondido el Presupuesto')->autoclose(3000);
        }else{
            alert()->error('El Presupuesto no se pudo responder','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('cliente/presupuesto');
    }
}
