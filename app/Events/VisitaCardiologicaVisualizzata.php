<?php

namespace App\Events;

use App\Models\SphereUser;
use App\Models\VisitaCardiologica;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitaCardiologicaVisualizzata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitaCardiologica;
    public $sphereUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VisitaCardiologica $visitaCardiologica , SphereUser $sphereUser)
    {
        $this->visitaCardiologica = $visitaCardiologica;
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
