<?php

namespace App\Listeners;

use App\Events\PazienteAperto;
use App\Models\SphereUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPazienteAperto
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
     * @param  \App\Events\PazienteAperto  $event
     * @return void
     */
    public function handle(PazienteAperto $event)
    {
        return $event->sphereUser->pazientiAperti()->attach($event->paziente->id);
    }
}
