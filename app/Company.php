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

    //
    public function servicios(){
        return $this->belongsToMany('App\Service')->withTimestamps();
    }

    public function comunas(){
        return $this->belongsToMany('App\Commune')->withTimestamps();
    }

    public function fotos(){
        return $this->hasMany('App\Galery');
    }

    public function trabajadores(){
        return $this->hasMany('App\Employe');
    }

    public function solicitud(){
        return $this->hasOne('App\Order');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/perfil/'.$this->image;
    }
}
