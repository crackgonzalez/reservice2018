<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Order;
use App\Client;
use Auth;
use DB;

class ReservationController extends Controller
{
    //corregido
    public function index(){ 
        $reservas = Reservation::whereHas('orden', function($query){
            $empresa = Auth::user()->empresa->id;
            $query->where('company_id',$empresa)
                    ->where('date','>=',today())
                    ->orderBy('date','desc');
        })->get();
        return view('empresa.reserva.index')->with(compact('reservas'));
    }

    //corregido
	public function inicio(){ 
    	$reservas = Reservation::whereHas('orden', function($query){
            $cliente = Auth::user()->cliente->id;
            $query->where('client_id',$cliente)
                    ->where('date','>=',today())
                    ->orderBy('date','desc');
        })->get();        
        return view('cliente.reserva.index')->with(compact('reservas'));
    }

    public function asignar(){
        $reservas = Reservation::whereHas('orden', function($query){
            $empresa = Auth::user()->empresa->id;
            $query->where('company_id',$empresa)->orderBy('date','desc');
        })
        ->where('employe_id',null)->get();
        return view('empresa.asignar.index')->with(compact('reservas'));
    }

    public function trabajos(){ 
        $reservas = Reservation::whereHas('orden', function($query){
            $trabajador = Auth::user()->trabajador->id;
            $query->where('employe_id',$trabajador)
                    ->where('date','>=',today())
                    ->orderBy('date','desc');
        })->get();
        return view('trabajador.reserva.index')->with(compact('reservas'));
    }

    public function mapa(Order $orden){
        $cliente = $orden->cliente;
        $empresa = $orden->empresa;
        return view('trabajador.reserva.mapa')->with(compact('cliente','empresa'));
    }

    public function resumenEmpresa(){       
        $reservas = Reservation::join('quotes','quotes.id','=','quote_id')
                                ->select('quotes.date','quotes.company_id',DB::raw("COUNT(quotes.company_id) as reserva"))->groupBy('quotes.company_id','quotes.date')->get();
         
        return view('empresa.resumen-reserva.index')->with(compact('reservas'));
    }

    public function resumenTrabajadores(){
        $empresa = Auth::user()->empresa->id;
        $trabajadores = Reservation::join('quotes','quotes.id','=','quote_id')
                                    ->join('employes','employes.id','=','employe_id')
                                    ->join('users','users.id','=','employes.user_id')
                                    ->select('users.name',DB::raw("COUNT(employes.id) as trabajador"))->where('quotes.company_id','=',$empresa)->groupBy('users.name')->get();
        return view('empresa.resumen-trabajador.index')->with(compact('trabajadores'));
    }

    //Resumen de la Cantidad de Reservas de Todas las Empresas
    public function resumenEmpresasAdmin(){
        $reservas = Reservation::join('quotes','quotes.id','=','quote_id')
                    ->join('companies','companies.id','=','quotes.company_id')
                    ->join('users','users.id','=','companies.user_id')
                    ->select('users.name',DB::raw("COUNT(companies.id) as reserva"))->groupBy('users.name')->get();

    	return view('administrador.resumen.index')->with(compact('reservas'));
    }   

    

    public function edit($id){ 
        $reserva = Reservation::find($id);       
        return view('empresa.asignar.edit')->with(compact('reserva'));
    }

    public function update(Request $requerimiento, $id){ 
        $mensajes =[

        ];
        $reglas = [

        ];

        $this->validate($requerimiento,$reglas,$mensajes);

        $reserva = Reservation::find($id);
        $reserva->employe_id = $requerimiento->employe_id;
        $exito = $reserva->update();
        if($exito){
            alert()->success('Se asigno correctamente el trabajador','Trabajador Asignado')->autoclose(3000);
        }else{
            alert()->error('El trabajador no pudo ser asignado','Ocurrio un Error')->autoclose(3000);
        }

        return redirect('empresa/asignar');
    }
}
