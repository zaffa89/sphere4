<?php

namespace App\Listeners;

use App\Events\PrenotazioneAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPrenotazioneAperta
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
     * @param  \App\Events\PrenotazioneAperta  $event
     * @return void
     */
    public function handle(PrenotazioneAperta $event)
    {
        //
    }
}
