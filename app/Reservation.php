<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function orden(){
        return $this->belongsTo('App\Quote','quote_id');
    }

    public function trabajador(){
        return $this->belongsTo('App\Employe','employe_id');
    }

    protected $dispatchesEvents = [
        'created' => Events\ModificarCreditEvent::class,    
    ];
}
