<?php

namespace App\Listeners;

use App\Events\VisitaCardiologicaAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisitaCardiologicaAperta
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
     * @param  \App\Events\VisitaCardiologicaAperta  $event
     * @return void
     */
    public function handle(VisitaCardiologicaAperta $event)
    {
        //
    }
}
