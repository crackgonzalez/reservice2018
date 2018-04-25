<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class WebpayController extends Controller
{
    public function index(){
    	$planes = Plan::all();    	
        return view('empresa.creditos.index')->with(compact('planes'));
    }

    public function webpay(){
    	return view('empresa.creditos.webpay');
    }
}
