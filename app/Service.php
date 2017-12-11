<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $fillable = ['service','category_id'];

    //Un Servicio Pertenece a una Categoria
    public function categoria(){
    	return $this->belongsTo('App\Category','category_id');
    }

    //retorna la ruta completa para mostrar la imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/servicios/'.$this->image;
    }
}
