<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['phone','address','description','commune_id'];
	//Relaciones

    //Una Empresa Pertenece a una Cuenta de Usuario
    public function usuario(){
        return $this->belongsTo('App\User','user_id');
    }

    //Una Empresa Pertenece a una Comuna
    public function comuna(){
        return $this->belongsTo('App\Commune','commune_id');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/perfil/'.$this->image;
    }
}
