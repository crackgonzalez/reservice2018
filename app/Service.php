<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $fillable = ['service','category_id'];

    //Relaciones

    //Un Servicio Pertenece a una Categoria
    public function categoria(){
    	return $this->belongsTo('App\Category','category_id');
    }

    //
    public function empresas(){
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/servicios/'.$this->image;
    }

    public function scopeServicio($query,$service_id){
         if(trim($service_id) !="" && $service_id!=0){
             return $query->where('id','=',$service_id)->orderBy('service','asc');
         }        
    }
}
