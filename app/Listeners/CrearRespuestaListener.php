<?php

namespace App\Listeners;

use App\Events\CrearRespuestaEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Quote;
use App\Response;
use App\Company;

class CrearRespuestaListener
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
     * @param  CrearRespuestaEvent  $event
     * @return void
     */
    public function handle(CrearRespuestaEvent $event)
    {
        if($event->quote->model == 1){
            $empresas = Company::all(); 
            foreach ($empresas as $empresa){
                foreach ($empresa->servicios as $servicio) {
                    if ($servicio->id == $event->quote->service_id) {
                        $respuesta = new Response();
                        $respuesta->quote_id = $event->quote->id;
                        $respuesta->company_id = $empresa->id;
                        $respuesta->save();
                    }   
                }  
            }          
        }
    }
}
