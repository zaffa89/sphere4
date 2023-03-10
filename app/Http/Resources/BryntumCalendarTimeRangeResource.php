<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BryntumCalendarTimeRangeResource extends JsonResource
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
            //'name' => 'orariomedico',
            'resourceId' => $this->ambulatorio_id,
            'startDate' => $this->data_inizio,
            'endDate' => $this->data_fine,
            'medico_id' => $this->medico_id,
            "cls" => "background-orario",
            "iconCls" => "b-icon b-fa-glass-cheers",
            "alignment"  => "start",
        ];
    }
}
