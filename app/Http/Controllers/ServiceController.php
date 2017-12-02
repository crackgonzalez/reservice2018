<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    //
    public function index(){
    	$servicios = Service::orderBy('service','asc')->paginate(15);
    	return view('administrador.servicios.index')->with(compact('servicios'));
    }
    
}
