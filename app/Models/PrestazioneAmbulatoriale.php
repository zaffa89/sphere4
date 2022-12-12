<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_ambulatoriali';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }
}
