<?php

namespace App\Events;

use App\Models\SphereUser;
use App\Models\VisitaFisioterapica;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VisitaFisioterapicaVisualizzata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitaFisioterapica;
    public $sphereUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VisitaFisioterapica $visitaFisioterapica , SphereUser $sphereUser)
    {
        $this->visitaFisioterapica = $visitaFisioterapica;
        $this->sphereUser = $sphereUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
