<?php

namespace App\Listeners;

use App\Events\VisitaFisioterapicaAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisitaFisioterapicaAperta
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
     * @param  \App\Events\VisitaFisioterapicaAperta  $event
     * @return void
     */
    public function handle(VisitaFisioterapicaAperta $event)
    {
        //
    }
}
