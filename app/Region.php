<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = ['region'];

	//Una Region Tiene Muchas Comunas
    public function comunas(){
    	return $this->hasMany('App\Commune');
    }

    //retorna la ruta completa para mostrar la imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/regiones/'.$this->image;
    }
}
