<?php

namespace App\Events;

use App\Models\Fattura;
use App\Models\SphereUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FatturaVisualizzata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fattura;
    public $sphereUser;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fattura $fattura , SphereUser $sphereUser)
    {
        $this->fattura = $fattura;
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
