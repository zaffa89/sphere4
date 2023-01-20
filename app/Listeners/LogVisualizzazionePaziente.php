<?php

namespace App\Listeners;

use App\Events\PazienteVisualizzato;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazionePaziente implements ShouldQueue
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
     * @param  \App\Events\PazienteVisualizzato  $event
     * @return void
     */
    public function handle(PazienteVisualizzato $event)
    {
        return $event->visualizzazioniPazienti()->attach($event->paziente->id);
    }
}
