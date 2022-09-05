<?php

namespace App\Listeners;

use App\Events\VisitaFisioterapicaVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazioneFisioterapica implements ShouldQueue
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
     * @param  \App\Events\VisitaFisioterapicaVisualizzata  $event
     * @return void
     */
    public function handle(VisitaFisioterapicaVisualizzata $event)
    {
        return $event->sphereUser->visualizzazioniVisiteFisioterapiche()->attach($event->visitaFisioterapica->id);
    }
}
