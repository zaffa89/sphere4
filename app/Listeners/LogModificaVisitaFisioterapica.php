<?php

namespace App\Listeners;

use App\Events\VisitaFisioterapicaModificata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModificaVisitaFisioterapica implements ShouldQueue
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
     * @param  \App\Events\VisitaFisioterapicaModificata  $event
     * @return void
     */
    public function handle(VisitaFisioterapicaModificata $event)
    {
        //
    }
}
