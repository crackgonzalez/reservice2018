<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cliente(){
        return $this->belongsTo('App\Client','client_id');
    }

    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    public function servicio(){
        return $this->belongsTo('App\Service','service_id');
    }

    public function tramo(){
        return $this->belongsTo('App\Section','section_id');
    }

    public function comuna(){
        return $this->belongsTo('App\Commune','commune_id');
    }

    public function getUrlAttribute(){
        if(substr($this->image,0,4)==="http"){
            return $this->image;
        }
        return '/imagenes/ordenes/'.$this->image;
    }

    public function reserva(){
        return $this->hasOne('App\Reservation');
    }

    //Eventos Para el Order
    protected $dispatchesEvents = [
        'updated' => Events\GenerarReservaEvent::class,      
    ];


}
