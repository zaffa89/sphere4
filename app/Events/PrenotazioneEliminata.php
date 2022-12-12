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

class PrenotazioneEliminata implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $prenotazione;
    public $sphereUser;
    public $client_uuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prenotazione $prenotazione , SphereUser $sphereUser , $client_uuid)
    {
        //$this->prenotazione = new PrenotazioneCalendarioResource($prenotazione);
        $this->sphereUser = $sphereUser;
        $this->client_uuid = $client_uuid;
    }

    public function broadcastAs()
    {
        return 'prenotazione.delete';
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
