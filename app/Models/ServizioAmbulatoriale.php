<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServizioAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'servizi_ambulatoriali';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }
}
