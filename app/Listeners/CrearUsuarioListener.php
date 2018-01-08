<?php

namespace App\Listeners;

use App\Events\CrearUsuarioEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;
use App\Client;

class CrearUsuarioListener
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
     * @param  CrearUsuarioEvent  $event
     * @return void
     */
    public function handle(CrearUsuarioEvent $event)
    {
        if($event->user->account_id == 3){
            $empresa = new Company();
            $empresa->user_id = $event->user->id;
            $empresa->save();
        }elseif($event->user->account_id == 4){
            $cliente = new Client();
            $cliente->user_id = $event->user->id;
            $cliente->save();
        }
    }
}
