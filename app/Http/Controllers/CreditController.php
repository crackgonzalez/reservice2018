<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use App\Buy;
use App\Bank;
use Exception;
use Auth;

class CreditController extends Controller
{
    public function create(){
    	$planes = Credit::all();
        $bancos = Bank::orderBy('name','asc')->get();    	
        return view('cliente.creditos.create')->with(compact('planes','bancos'));
    }

    public function store(Request $request){
    	$mensajes =[
    		'plans.exists' =>'Debe seleccionar un plan',
            'bancos.exists' =>'Debe seleccionar un banco',
            'tarjeta.required' =>'El campo de numero de tarjeta es obligatorio',
            'tarjeta.numeric' =>'El campo de numero de tarjeta solo acepta valores numericos',
    	];
    	$reglas = [
    		'plans' => 'exists:plans,id',
            'bancos' => 'exists:banks,id',
            'tarjeta' => 'required|numeric',
    	];

        $this->validate($request,$reglas,$mensajes);

        try {
            $pago = new Buy();
            $pago->bank_id = $request->input('bancos'); 
            $pago->tarjet = $request->input('tarjeta');
            $pago->client_id = Auth::user()->cliente->id;
            $pago->credit_id = $request->input('plans');  
            $exito = $pago->save();
            if ($exito) {
                alert()->success('El pago fue realizado con exito, se han cargado los creditos a su cuenta','Pago Realizado')->autoclose(5000);
            }else{
                alert()->warning('El pago no se pudo realizar','Pago Rechazado')->autoclose(3000);
            }
        } catch (Exception $e) {
            alert()->error('El pago no se pudo realizar debido a un error','Ocurrio un Error')->autoclose(30000);
        }

    	return redirect('cliente/perfil');
    }
}
