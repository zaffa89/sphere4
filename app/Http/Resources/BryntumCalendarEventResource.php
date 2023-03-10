<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BryntumCalendarEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [            
            'id' => $this->id,
            'prenotazione_id' => $this->id,
            'name' => match($this->sezione_visita) {
                'M' => $this->whenLoaded('visitaMedsport')->paziente->ragione_sociale.' | '.$this->whenLoaded('visitaMedsport')->listino->codice,
                'A' => $this->whenLoaded('visitaAmbulatoriale')->paziente->ragione_sociale.' | '.$this->whenLoaded('visitaAmbulatoriale')->listino->codice,
                'SM' , 'SA' => $this->whenLoaded('societaSportiva')->ragione_sociale,
                'N' => 'NOTA',
                'X' => 'ASSENZA',
                default => ''
            },
            'sezione_visita' => $this->sezione_visita,
            'startDate' => $this->data_inizio,
            'endDate' => $this->data_fine,
            'resourceId' => $this->ambulatorio_id, //ambulatorio
            'note' => $this->note
        ];
    }
}
