<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefertoFisioterapia extends Model
{
    use HasFactory;

    protected $table = 'referti_fisioterapia';

    protected $guarded = [];

    public function visita() {
        return $this->belongsTo(VisitaAmbulatoriale::class);
    }
}
