<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\Company;
use App\Category;
use App\Service;

class WelcomeController extends Controller
{
	//Vista de inicio de la pagina
    public function inicio(Request $request){
    	$servicios = Service::servicio($request->input('service_id'))->orderBy('service','asc')->get();
        $categorias = Category::orderBy('category','asc')->get(); 
        return view('welcome')->with(compact('servicios','categorias'));
    }
}
