<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	//Lista las categorias por orden ascendente 
    public function index(){
    	$categorias = Category::orderBy('category','asc')->get();
    	return view('administrador.categorias.index')->with(compact('categorias'));
    }
}

