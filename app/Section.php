<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function solicitud(){
        return $this->hasOne('App\Order');
    }
    
}
