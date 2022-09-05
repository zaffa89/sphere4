<?php

namespace App\Events;

use App\Models\Prenotazione;
use App\Models\SphereUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrenotazioneModificata
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $prenotazione;
    public $sphereUser;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prenotazione $prenotazione , SphereUser $sphereUser)
    {
        $this->prenotazione = $prenotazione;
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
