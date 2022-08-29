<?php

namespace App\Listeners;

use App\Events\FatturaAperta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFatturaAperta
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
     * @param  \App\Events\FatturaAperta  $event
     * @return void
     */
    public function handle(FatturaAperta $event)
    {
        //
    }
}
