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
    	$servicios = DB::table('company_service')
    					->join('services','services.id','=','service_id')
    					->join('companies','companies.id','=','company_id')
    					->join('users','users.id','=','companies.user_id')
    					->where('services.service','like','%'.$request->input('search_text').'%')
    					->where('companies.credit','>','0')
    					->where('users.state','=','1')
    					->orderBy('price',$request->input('price'))->get();
        return view('welcome')->with(compact('servicios'));
    }
}
