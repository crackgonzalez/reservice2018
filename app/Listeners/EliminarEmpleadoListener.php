<?php

namespace App\Listeners;

use App\Events\EliminarEmpleadoEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Employe;
use App\User;

class EliminarEmpleadoListener
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
     * @param  EliminarEmpleadoEvent  $event
     * @return void
     */
    public function handle(EliminarEmpleadoEvent $event)
    {
        $usuario = User::find($event->employe->user_id);
        $usuario->delete();
    }
}
