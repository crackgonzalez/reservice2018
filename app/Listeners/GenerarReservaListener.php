<?php

namespace App\Listeners;

use App\Events\GenerarReservaEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;
use App\Order;

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
        if($event->order->state_company && $event->order->state_client){
            $reserva = new Reservation();            
            $reserva->order_id = $event->order->id;
            $reserva->save();
        }
    }
}
