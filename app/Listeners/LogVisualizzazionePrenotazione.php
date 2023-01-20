<?php

namespace App\Listeners;

use App\Events\PrenotazioneVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazionePrenotazione implements ShouldQueue
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
     * @param  \App\Events\PrenotazioneVisualizzata  $event
     * @return void
     */
    public function handle(PrenotazioneVisualizzata $event)
    {
        return $event->visualizzazioniPrenotazioni()->attach($event->prenotazione->id);
    }
}
