<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //Una cuenta tiene un usuario
    public function usuario(){
    	return $this->hasOne('App\User');
    }
}
