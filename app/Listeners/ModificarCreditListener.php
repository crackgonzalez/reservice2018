<?php

namespace App\Listeners;

use App\Events\ModificarCreditEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;
use App\Reservation;

class ModificarCreditListener
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
     * @param  ModificarCreditEvent  $event
     * @return void
     */
    public function handle(ModificarCreditEvent $event)
    {
        if($event->reservation->orden->state_company == 1 && $event->reservation->orden->state_client == 1){
            $empresa = Company::find($event->reservation->orden->company_id); 
            $empresa->credit = $empresa->credit - 1;
            $empresa->save();                    
        }
    }
}
