<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatiCliniciMedsport extends Model
{
    use HasFactory;

    protected $table = "dati_clinici_medsport";

    protected $guarded = [];

    public function visita() 
    {
        return $this->belongsTo(VisitaMedsport::class , 'visita_id');
    }
}
