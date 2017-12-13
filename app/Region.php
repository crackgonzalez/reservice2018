<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = ['region'];
    //falta crear relacion con los servicios

    //retorna la ruta completa para mostrar la imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/regiones/'.$this->image;
    }
}
