<?php

namespace App\Listeners;

use App\Events\FatturaVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazioneFattura implements ShouldQueue
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
     * @param  \App\Events\FatturaVisualizzata  $event
     * @return void
     */
    public function handle(FatturaVisualizzata $event)
    {
        return $event->visualizzazioniFatture()->attach($event->fattura->id);
    }
}
