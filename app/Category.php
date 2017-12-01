<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Una Categoria Tiene Muchos Servicios
    public function servicios(){
    	return $this->hasMany(Service::class);
    }
}
