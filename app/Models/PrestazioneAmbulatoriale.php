<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_ambulatoriali';
    
    protected $guarded = [];

    public function listini()
    {
        return $this->belongsToMany(ListinoAmbulatoriale::class , 'listino_prestazione_ambulatoriale' , 'prestazione_ambulatoriale_id' , 'listino_ambulatoriale_id');
    }
}
