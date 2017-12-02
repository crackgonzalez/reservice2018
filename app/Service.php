<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //Un Servicio Pertenece a una Categoria
    public function categoria(){
    	return $this->belongsTo('App\Category','category_id');
    }
}
