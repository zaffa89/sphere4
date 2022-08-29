<?php

namespace App\Listeners;

use App\Events\PrenotazioneModificata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModificaPrenotazione implements ShouldQueue
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
     * @param  \App\Events\PrenotazioneModificata  $event
     * @return void
     */
    public function handle(PrenotazioneModificata $event)
    {
        //
    }
}
