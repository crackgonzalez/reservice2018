<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{

	public function usuario(){
        return $this->belongsTo('App\User','user_id');
    }

    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    //Retorna la Imagen
    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/perfil/'.$this->image;
    }
}
