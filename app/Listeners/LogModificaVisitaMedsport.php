<?php

namespace App\Listeners;

use App\Events\VisitaMedsportModificata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModificaVisitaMedsport implements ShouldQueue
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
     * @param  \App\Events\VisitaMedsportModificata  $event
     * @return void
     */
    public function handle(VisitaMedsportModificata $event)
    {
        //
    }
}
