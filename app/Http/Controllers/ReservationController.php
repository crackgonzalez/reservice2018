<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Order;
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

    public function resumen(){
        $reservas = Reservation::join('orders','orders.id','=','order_id')
                                ->join('companies','companies.id','=','orders.company_id')
                                ->join('users','users.id','=','companies.user_id')
                                ->select('users.name',DB::raw("COUNT(companies.id) as count_click"))->groupBy('users.name')->get();

    	return view('administrador.resumen.index')->with(compact('reservas'));
    }    
}


 // $reservas = Reservation::join('orders','orders.id','=','order_id')
 //                                ->join('companies','companies.id','=','orders.company_id')
 //                                ->join('users','users.id','=','companies.user_id')
 //                                ->select('users.name')->count();
 //        return view('administrador.resumen.index')->with(compact('reservas'));