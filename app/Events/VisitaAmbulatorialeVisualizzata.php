<?php

namespace App\Events;

use App\Models\User;
use App\Models\VisitaAmbulatoriale;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitaAmbulatorialeVisualizzata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitaAmbulatoriale;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VisitaAmbulatoriale $visitaAmbulatoriale , User $user)
    {
        $this->visitaAmbulatoriale = $visitaAmbulatoriale;
        $this->user = $user;
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
