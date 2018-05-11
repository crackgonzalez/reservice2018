<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\Company;
use App\Category;
use App\Service;
use DB;

class WelcomeController extends Controller
{
	//Vista de inicio de la pagina
    public function inicio(Request $request){
    	$min = 0;
    	$max = 1000000;
    	if($request->input('price') == 1){
    		$min = 1;
    		$max = 10000;
    	}elseif ($request->input('price') == 2) {
    		$min = 10001;
    		$max = 50000;
    	}elseif ($request->input('price') == 3) {
    		$min = 50001;
    		$max = 100000;
    	}
    	$servicios = DB::table('company_service')
    					->join('services','services.id','=','service_id')
    					->join('companies','companies.id','=','company_id')
    					->join('users','users.id','=','companies.user_id')
    					->where('services.service','like','%'.$request->input('search_text').'%')
    					->where('companies.credit','>','0')
    					->where('users.state','=','1')
    					->whereBetween('price',[$min,$max])
    					->orderBy('services.service','asc')->get();
        return view('welcome')->with(compact('servicios'));
    }
}
