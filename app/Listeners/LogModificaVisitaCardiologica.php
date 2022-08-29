<?php

namespace App\Listeners;

use App\Events\VisitaCardiologicaModificata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModificaVisitaCardiologica
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
     * @param  \App\Events\VisitaCardiologicaModificata  $event
     * @return void
     */
    public function handle(VisitaCardiologicaModificata $event)
    {
        //
    }
}
