<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListinoAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'listini_ambulatoriali';
    
    protected $guarded = [];
    
    public function prestazioni()
    {
        return $this->belongsToMany(PrestazioneAmbulatoriale::class , 'listino_prestazione_ambulatoriale' , 'listino_ambulatoriale_id' , 'prestazione_ambulatoriale_id');
    }

    public function visita()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }
}
