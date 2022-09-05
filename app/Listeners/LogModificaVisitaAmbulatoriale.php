<?php

namespace App\Listeners;

use App\Events\VisitaAmbulatorialeModificata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModificaVisitaAmbulatoriale implements ShouldQueue
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
     * @param  \App\Events\VisitaAmbulatorialeModificata  $event
     * @return void
     */
    public function handle(VisitaAmbulatorialeModificata $event)
    {
        //
    }
}
