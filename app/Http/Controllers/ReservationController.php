<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Order;

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
}
