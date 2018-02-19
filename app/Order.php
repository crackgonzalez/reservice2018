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

}
