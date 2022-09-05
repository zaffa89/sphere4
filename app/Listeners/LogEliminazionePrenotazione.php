<?php

namespace App\Listeners;

use App\Events\PrenotazioneEliminata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogEliminazionePrenotazione implements ShouldQueue
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
     * @param  \App\Events\PrenotazioneEliminata  $event
     * @return void
     */
    public function handle(PrenotazioneEliminata $event)
    {
        //
    }
}
