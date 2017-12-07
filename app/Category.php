<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['category'];

    //Una Categoria Tiene Muchos Servicios
    public function servicios(){
    	return $this->hasMany('App\Service');
    }

    //retorna la ruta completa para mostrar la imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/categorias/'.$this->image;
    }
}
