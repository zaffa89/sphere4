<?php

namespace App\Listeners;

use App\Events\NotificaPrenotazioneModificata;
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
     * @param  \App\Events\NotificaPrenotazioneModificata  $event
     * @return void
     */
    public function handle(NotificaPrenotazioneModificata $event)
    {        
        
    }
}
