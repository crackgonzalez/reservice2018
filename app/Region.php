<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = ['region'];

	//Relaciones

    //Una Region Tiene Varias Comunas
    public function comunas(){
    	return $this->hasMany('App\Commune');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/regiones/'.$this->image;
    }
}
