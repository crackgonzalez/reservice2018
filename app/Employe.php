<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{

    protected $fillable = ['phone'];

	public function usuario(){
        return $this->belongsTo('App\User','user_id');
    }

    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    public function reserva(){
        return $this->hasOne('App\Reservation');
    }

    public function clientes(){
        return $this->belongsToMany('App\Client')->withTimestamps();
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/perfil/'.$this->image;
    }

    //Eventos Para el Trabajador
    protected $dispatchesEvents = [
        'deleted' => Events\EliminarEmpleadoEvent::class,      
    ];

}
