<?php

namespace App\Events;

use App\Models\User;
use App\Models\Prenotazione;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Http\Resources\PrenotazioneCalendarioResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificaPrenotazioneModificata implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $prenotazione;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prenotazione $prenotazione , $username)
    {        
        $this->prenotazione = new PrenotazioneCalendarioResource($prenotazione);

        
        $this->message = $username.' ha modificato la prenotazione con ID '.$prenotazione->id;
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
