<?php

namespace App\Listeners;

use App\Events\VisitaMedsportVisualizzata;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVisualizzazioneVisitaMedsport implements ShouldQueue
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
     * @param  \App\Events\VisitaMedsportVisualizzata  $event
     * @return void
     */
    public function handle(VisitaMedsportVisualizzata $event)
    {
        return $event->sphereUser->visualizzazioniVisiteMedsport()->attach($event->visitaMedsport->id);
    }
}
