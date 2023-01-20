<?php

namespace App\Listeners;

use App\Events\VisitaAmbulatorialeVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazioneVisitaAmbulatoriale implements ShouldQueue
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
     * @param  \App\Events\VisitaAmbulatorialeVisualizzata  $event
     * @return void
     */
    public function handle(VisitaAmbulatorialeVisualizzata $event)
    {
        return $event->visualizzazioniVisiteAmbulatoriali()->attach($event->visitaAmbulatoriale->id);
    }
}
