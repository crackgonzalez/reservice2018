<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use File;
use Exception;
use Alert;

class CategoryController extends Controller
{
	//Lista las Categorias por Orden Ascendente y Paginado en 16 Registros
    public function listarCategorias(){
    	$categorias = Category::orderBy('category','asc')->paginate(16);
    	return view('administrador.categorias.index')->with(compact('categorias'));
    }

    //Envia a Formulario para Crear una Categoria
    public function crearCategoria(){
    	return view('administrador.categorias.create');
    }

    //Guarda en la BD la Categoria
    public function guardarCategoria(Request $requerimiento){  

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

        $categoria = Category::create($requerimiento->only('category'));

        if($requerimiento->hasFile('image')){
            $foto = $requerimiento->file('image');
            $ruta = public_path().'/imagenes/categorias';
            $nombreFoto = uniqid().$foto->getClientOriginalName();
            $movido = $foto->move($ruta,$nombreFoto);

            if($movido){
                $categoria->image = $nombreFoto;
                $categoria->save();
                alert()->success('La categoria fue ingresada correctamente','Categoria Agregada')->autoclose(3000);
            }else{
                alert()->error('La categoria no pudo ser ingresada','Ocurrio un Error')->autoclose(3000);
            }
        }
        return redirect('administrador/categorias');
    }

    //Envia a Formulario para Editar una Categoria
    public function editarCategoria(Category $categoria){
        return view('administrador.categorias.edit')->with(compact('categoria'));
    }

    //Edita la Categoria Guardada en la BD
    public function actualizarCategoria(Request $requerimiento, Category $categoria){  
        
        $mensajes =[
            'category.required' =>'El campo categoria es obligatorio',
            'category.min' =>'El campo categoria debe tener al menos 2 caracteres',
            'category.max' =>'El campo categoria debe tener como maximo 30 caracteres',
            'category.regex' => 'El campo categoria solo acepta cadenas de texto y valores numericos',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, bmp, png.'
        ];

        $reglas = [
            'category' => 'required|min:2|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'image' => 'mimes:jpg,jpeg,bmp,png'    
        ];

        $this->validate($requerimiento,$reglas,$mensajes);
            try {

                if($requerimiento->hasFile('image')){
                    $foto = $requerimiento->file('image');
                    $ruta = public_path().'/imagenes/categorias';
                    $nombreFoto = uniqid().$foto->getClientOriginalName();
                    $movido = $foto->move($ruta,$nombreFoto);

                    if($movido){
                        $imagenAnterior = $ruta.'/'.$categoria->image;
                        $categoria->image = $nombreFoto;
                        $exito = $categoria->save();                        
                        if($exito){
                            File::delete($imagenAnterior);
                            alert()->success('La categoria fue modificada correctamente','Categoria Modificada')->autoclose(3000);
                        }
                    }
                }else{
                    $modificada = $categoria ->update($requerimiento->only('category'));
                    if($modificada){
                        alert()->success('La categoria fue modificada correctamente','Categoria Modificada')->autoclose(3000);
                    }else{
                        alert()->error('La categoria no pudo ser modificada','Ocurrio un Error')->autoclose(3000);
                    }
                }
            } catch (Exception $e) {
                alert()->warning('La categoria ya se encuentra registrada','Advetencia')->autoclose(3000);
            }
        return redirect('administrador/categorias');
    }

    //Elimina una Categoria de la BD
    public function eliminarCategoria($id){
        try {
            $categoria = Category::find($id);
            $ruta = public_path().'/imagenes/categorias';
            $rutaImagen = $ruta.'/'.$categoria->image;
            $exito = $categoria->delete();
            if($exito){
                File::delete($rutaImagen);
                alert()->success('La categoria fue eliminada correctamente','Categoria Eliminada')->autoclose(3000);
            }
        } catch (Exception $e) {
            alert()->warning('La categoria se encuentra asociada a un servicio','No se Puede Eliminar')->autoclose(3000);
        }        
        return redirect('administrador/categorias');
    }
}

