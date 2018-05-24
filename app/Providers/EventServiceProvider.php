<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CrearUsuarioEvent' => [
            'App\Listeners\CrearUsuarioListener',
        ],
        'App\Events\EliminarEmpleadoEvent' => [
            'App\Listeners\EliminarEmpleadoListener',
        ],
        'App\Events\GenerarReservaEvent' => [
            'App\Listeners\GenerarReservaListener',
        ],
        'App\Events\ModificarCreditEvent' => [
            'App\Listeners\ModificarCreditListener',
        ],
        'App\Events\CargarCreditEvent' => [
            'App\Listeners\CargarCreditListener',
        ],
        'App\Events\CrearRespuestaEvent' => [
            'App\Listeners\CrearRespuestaListener',
        ],
        'App\Events\CargarCreditUserEvent' => [
            'App\Listeners\CargarCreditUserListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
