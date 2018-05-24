<?php

namespace App\Listeners;

use App\Events\GenerarReservaMultipleEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;
use App\Quote;
use App\Response;
use App\Company;
use App\Client;

class GenerarReservaMultipleListener
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
     * @param  GenerarReservaMultipleEvent  $event
     * @return void
     */
    public function handle(GenerarReservaMultipleEvent $event)
    {
        if($event->response->state_company == 1 && $event->response->state_client == 1){
            $solicitud = Quote::find($event->response->presupuesto->id);
            $solicitud->company_id = $event->response->company_id;
            $solicitud->update();

            $reserva = new Reservation();            
            $reserva->quote_id = $event->response->presupuesto->id;  
            $reserva->save();

            $respuestas = Response::where('quote_id','=',$event->response->presupuesto->id)->get();
            foreach ($respuestas as $respuesta) {
                if ($respuesta->company_id != $event->response->company_id) {
                    $respuesta->state_client = 3;
                    $respuesta->update();
                }
            }

            $empresa = Company::find($event->response->company_id); 
            $empresa->credit = $empresa->credit - 1;
            $empresa->save();

            $cliente = Client::find($event->response->presupuesto->client_id); 
            $cliente->credit = $cliente->credit - 1;
            $cliente->save();
        }
    }
}
