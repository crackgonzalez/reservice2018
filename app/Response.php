<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function presupuesto(){
    	return $this->belongsTo('App\Quote','quote_id');
    }

    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    protected $dispatchesEvents = [
        'updated' => Events\GenerarReservaMultipleEvent::class,   
    ];
}
