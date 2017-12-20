<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	//Relaciones
	
	//Un Tipo de Cuenta Tiene Varios Usuarios
    public function usuarios(){
    	return $this->hasMany('App\User');
    }
}
