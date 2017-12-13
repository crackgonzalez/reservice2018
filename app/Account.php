<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //Una cuenta tiene un usuario
    public function usuario(){
    	return $this->belongsTo('App\User','account_id');
    }
}
