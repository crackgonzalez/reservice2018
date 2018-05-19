<?php

namespace App\Listeners;

use App\Events\GenerarReservaEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;
use App\Quote;

class GenerarReservaListener
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
     * @param  GenerarReservaEvent  $event
     * @return void
     */
    public function handle(GenerarReservaEvent $event)
    {
        if($event->quote->state_company == 1 && $event->quote->state_client == 1){
            $reserva = new Reservation();            
            $reserva->quote_id = $event->quote->id;  
            $reserva->save();                      
        }
    }
}
