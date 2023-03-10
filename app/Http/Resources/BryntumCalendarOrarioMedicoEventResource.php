<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BryntumCalendarOrarioMedicoEventResource extends JsonResource
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
            'id' => 'orario'.$this->id,
            'orario_medico_id' => $this->id,
            'startDate' => $this->data_inizio,
            'endDate' => $this->data_fine,
            'allDay' => true,
            'name' => $this->medico['ragione_sociale'],
            'resourceId' => $this->ambulatorio_id,
            'sezione_visita' => 'ORARIO'  //fasullo, usato solo per aprire il modal corretto
        ];
    }
}
