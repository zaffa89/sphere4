<?php

namespace App\Events;

use App\Models\Paziente;
use App\Models\SphereUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PazienteAperto
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sphereUser;
    public $paziente;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Paziente $paziente , SphereUser $sphereUser)
    {
        $this->sphereUser = $sphereUser;
        $this->paziente = $paziente;
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
