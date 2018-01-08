<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['phone','address','commune_id'];

	//Una Empresa Pertenece a una Cuenta de Usuario
    public function usuario(){
        return $this->belongsTo('App\User','user_id');
    }

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
