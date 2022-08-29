<?php

namespace App\Listeners;

use App\Events\VisitaMedsportAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisitaMedsportAperta
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
     * @param  \App\Events\VisitaMedsportAperta  $event
     * @return void
     */
    public function handle(VisitaMedsportAperta $event)
    {
        //
    }
}
