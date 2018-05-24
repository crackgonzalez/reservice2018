<?php

namespace App\Listeners;

use App\Events\CargarCreditUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Client;
use App\Credit;

class CargarCreditUserListener
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
     * @param  CargarCreditUserEvent  $event
     * @return void
     */
    public function handle(CargarCreditUserEvent $event)
    {
        $cliente = Client::find($event->buy->client_id);
        $plan = Credit::find($event->buy->credit_id);
        $cliente->credit = $cliente->credit + $plan->credit;
        $cliente->save();
    }
}
