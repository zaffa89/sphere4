<?php

namespace App\Events;

use App\Models\SphereUser;
use App\Models\VisitaMedsport;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitaMedsportVisualizzata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitaMedsport;
    public $sphereUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VisitaMedsport $visitaMedsport , SphereUser $sphereUser)
    {
        $this->visitaMedsport = $visitaMedsport;
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
