<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $dispatchesEvents = [
        'created' => Events\CargarCreditEvent::class,    
    ];
}
