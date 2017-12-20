<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //En Construccion
    public function index(){
    	// $categorias = Category::orderBy('category','asc')->paginate(12);
        //$categorias = Category::orderBy('category')->get();
    	return view('empresa.perfil.index');
    }
}
