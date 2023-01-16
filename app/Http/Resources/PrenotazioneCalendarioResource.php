<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrenotazioneCalendarioResource extends JsonResource
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
            'text' => match($this->sezione_visita) {
                'M' => $this->whenLoaded('visitaMedsport')->paziente->ragione_sociale.' | '.$this->whenLoaded('visitaMedsport')->prestazione->codice,
                'A' => $this->whenLoaded('visitaAmbulatoriale')->paziente->ragione_sociale.' | '.$this->whenLoaded('visitaAmbulatoriale')->prestazione->codice,
                'SM' , 'SA' => $this->whenLoaded('societaSportiva')->ragione_sociale,
                'N' => 'NOTA',
                'X' => 'ASSENZA',
                default => ''
            },
            'id' => $this->id,       
            'societa_id' => $this->societa_id,
            //'societa_sportiva' => $this->whenLoaded('societaSportiva'),
            'data_prenotazione' => $this->data_prenotazione,
            'data_inizio' => $this->data_inizio,
            'data_fine' => $this->data_fine,
            'medico_id' => $this->medico_id,
            'ambulatorio_id' => $this->ambulatorio_id,
            'struttura_id' => $this->struttura_id,
            'sezione_visita' => $this->sezione_visita,
            'sport_id' => $this->sport_id,
            'visita' => match( $this->sezione_visita ) { 
                'M' , 'SM' => $this->whenLoaded('visitaMedsport'),
                'A' , 'SA' => $this->whenLoaded('visitaAmbulatoriale'),               
                default => null
            },
            'numero_paz' => match( $this->sezione_visita ) {
                'M' , 'SM' => $this->whenCounted('visiteMedsport'),
                'A' , 'SA' => $this->whenCounted('visiteAmbulatoriali'),             
                default => null
            },
            'note' => $this->note,
            'accettata' => $this->accettata,  
            'colore' => $this->colore,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at     
        ];
    }
}