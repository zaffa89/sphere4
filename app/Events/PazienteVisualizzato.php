<?php

namespace App\Events;

use App\Models\Paziente;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PazienteVisualizzato
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $paziente;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Paziente $paziente , User $user)
    {
        $this->user = $user;
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
