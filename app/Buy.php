<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $dispatchesEvents = [
        'created' => Events\CargarCreditUserEvent::class,    
    ];
}
