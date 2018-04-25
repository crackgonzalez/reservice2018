<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class WebpayController extends Controller
{
    public function create(){
    	$planes = Plan::all();    	
        return view('empresa.creditos.create')->with(compact('planes'));
    }

    public function store(){
    	return view('empresa.creditos.webpay');
    }
}
