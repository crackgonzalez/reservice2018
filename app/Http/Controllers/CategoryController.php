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
            'image.required' =>'La imagen es obligatoria',
            'category.min' =>'El campo categoria debe tener al menos 2 caracteres',
            'category.max' =>'El campo categoria debe tener como maximo 30 caracteres',
            'category.unique' => 'La categoria ya ha sido registrada en la base de datos',
            'category.regex' => 'El campo categoria solo acepta cadenas de texto y valores numericos',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.'

        ];

        $reglas = [
            'category' => 'required|min:2|max:30|unique:categories|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'required|mimes:jpg,jpeg,bmp,png'

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

