<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Pay;

class WebpayController extends Controller
{
    public function create(){
    	$planes = Plan::all();    	
        return view('empresa.creditos.create')->with(compact('planes'));
    }

    public function store(Request $request){
    	$mensajes =[
    		'plans.exists' =>'Debe seleccionar un plan',
    	];
    	$reglas = [
    		'plans' => 'exists:plans,id',
    	];
    	$pago = new Pay();

    	$this->validate($request,$reglas,$mensajes);
    	return redirect('empresa/perfil');
    }
}
