<?php

namespace App\Listeners;

use App\Events\VisitaAmbulatorialeAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisitaAmbulatorialeAperta
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
     * @param  \App\Events\VisitaAmbulatorialeAperta  $event
     * @return void
     */
    public function handle(VisitaAmbulatorialeAperta $event)
    {
        //
    }
}
