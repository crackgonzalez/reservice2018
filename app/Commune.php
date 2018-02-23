<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['commune','region_id'];

    //Relaciones

    //Una Comuna Pertenece a una Region
    public function region(){
    	return $this->belongsTo('App\Region','region_id');
    }

    //Una Comuna Tiene varias Empresas
    public function empresas(){
        return $this->hasMany('App\Company');
    }

    //Una Comuna Tiene varias Empresas
    public function clientes(){
        return $this->hasMany('App\Client');
    }

    public function empresasMany(){
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    public function solicitud(){
        return $this->hasOne('App\Order');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/comunas/'.$this->image;
    }
}
