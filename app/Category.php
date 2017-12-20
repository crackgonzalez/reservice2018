<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['category'];

    //Relaciones

    //Una Categoria Tiene Muchos Servicios
    public function servicios(){
    	return $this->hasMany('App\Service');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/categorias/'.$this->image;
    }
}
