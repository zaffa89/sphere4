<?php

namespace App\Listeners;

use App\Events\VisitaCardiologicaVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazioneVisitaCardiologica implements ShouldQueue
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
     * @param  \App\Events\VisitaCardiologicaVisualizzata  $event
     * @return void
     */
    public function handle(VisitaCardiologicaVisualizzata $event)
    {
        return $event->sphereUser->visualizzazioniVisiteCardiologiche()->attach($event->visitaCardiologica->id);
    }
}
