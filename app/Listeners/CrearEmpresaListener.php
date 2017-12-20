<?php

namespace App\Listeners;

use App\Events\CrearEmpresaEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;

class CrearEmpresaListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CrearEmpresaEvent  $event
     * @return void
     */

    //Crea una Empresa si la Cuenta de Usuario es Creada (Trigger)
    public function handle(CrearEmpresaEvent $event)
    {
        if($event->user->account_id == 3){
            $empresa = new Company();
            $empresa->user_id = $event->user->id;
            $empresa->save();
        }
    }
}
