<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	//Lista las categorias por orden ascendente y paginado en 10 registros
    public function index(){
    	$categorias = Category::orderBy('category','asc')->paginate(15);
    	return view('administrador.categorias.index')->with(compact('categorias'));
    }

    public function create(){
    	//return view('');
    }

    public function store(){
    	//return view('');
    }
}

