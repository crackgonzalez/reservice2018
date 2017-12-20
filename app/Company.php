<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	//Relaciones

    //Una Empresa Pertenece a una Cuenta de Usuario
    public function usuario(){
        return $this->belongsTo('App\User','user_id');
    }
}
