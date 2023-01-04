<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefertoCardiologia extends Model
{
    use HasFactory;

    protected $table = 'referti_cardiologia';

    protected $guarded = [];

    public function visita() {
        return $this->belongsTo(VisitaAmbulatoriale::class);
    }
}
