<?php

namespace App\Events;

use App\Models\User;
use App\Models\Fattura;
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
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fattura $fattura , User $user)
    {
        $this->fattura = $fattura;
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
