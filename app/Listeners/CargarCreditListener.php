<?php

namespace App\Listeners;

use App\Events\CargarCreditEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;
use App\Plan;

class CargarCreditListener
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
     * @param  CargarCreditEvent  $event
     * @return void
     */
    public function handle(CargarCreditEvent $event)
    {
        $empresa = Company::find($event->pay->company_id);
        $plan = Plan::find($event->pay->plan_id);
        $empresa->credit = $empresa->credit + $plan->credit;
        $empresa->save();
    }
}
