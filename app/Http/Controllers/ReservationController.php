<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Order;
use Auth;
use DB;

class ReservationController extends Controller
{
    public function index(){ 
    	$reservas = Reservation::orderBy('created_at','desc')->get();
        return view('empresa.reserva.index')->with(compact('reservas'));
    }

	public function inicio(){ 
    	$reservas = Reservation::orderBy('created_at','desc')->get();
        return view('cliente.reserva.index')->with(compact('reservas'));
    }

    public function trabajos(){ 
        $reservas = Reservation::orderBy('created_at','desc')->get();
        return view('trabajador.reserva.index')->with(compact('reservas'));
    }

    public function resumenEmpresa(Request $requerimiento){
       
        $reservas = Reservation::join('orders','orders.id','=','order_id')
                                ->select('orders.date','orders.company_id',DB::raw("COUNT(orders.company_id) as reserva"))->groupBy('orders.company_id','orders.date')->get();
         
        return view('empresa.resumen.index')->with(compact('reservas'));
    }


    //Resumen de la Cantidad de Reservas de Todas las Empresas
    public function resumenEmpresasAdmin(){
        $reservas = Reservation::join('orders','orders.id','=','order_id')
                    ->join('companies','companies.id','=','orders.company_id')
                    ->join('users','users.id','=','companies.user_id')
                    ->select('users.name',DB::raw("COUNT(companies.id) as reserva"))->groupBy('users.name')->get();

    	return view('administrador.resumen.index')->with(compact('reservas'));
    }   

    public function asignar(){
        $reservas = Reservation::orderBy('created_at','desc')->get();
        return view('empresa.asignar.index')->with(compact('reservas'));
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
