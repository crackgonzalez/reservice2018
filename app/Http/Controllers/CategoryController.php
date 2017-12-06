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
    	return view('administrador.categorias.create');
    }

    public function store(Request $requerimiento){  

        $mensajes =[
            'category.required' =>'El campo categoria es obligatorio',
            'image.required' =>'La imagen es obligatoria'
        ];
        $reglas = [
            'category' => 'required|min:2|max:30|unique:categories',
            'image' => 'required'

        ]; 

        $this->validate($requerimiento,$reglas,$mensajes);

        $foto = $requerimiento->file('image');
        $ruta = public_path().'/imagenes/categorias';
        $nombreFoto = uniqid().$foto->getClientOriginalName();
        $foto->move($ruta,$nombreFoto);

    	$categoria = new Category();
        $categoria->category = $requerimiento->input("category");
        $categoria->image = $nombreFoto;
        $categoria->save();

        return redirect('administrador/categorias');
    }
}

