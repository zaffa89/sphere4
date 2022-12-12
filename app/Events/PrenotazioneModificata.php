<?php

namespace App\Events;

use App\Models\SphereUser;
use App\Models\Prenotazione;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrenotazioneModificata implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $oldPrenotazione;
    public $prenotazione;
    public $sphereUser;
    public $client_uuid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prenotazione $prenotazione , $oldPrenotazione , SphereUser $sphereUser , $client_uuid)
    {        
        $this->oldPrenotazione = $oldPrenotazione;
        $this->prenotazione = $prenotazione;
        $this->client_uuid = $client_uuid;
        $this->sphereUser = $sphereUser;
    }

    public function broadcastAs()
    {
        return 'prenotazione.update';
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('calendario');
    }
}
