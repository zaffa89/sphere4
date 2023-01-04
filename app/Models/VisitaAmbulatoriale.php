<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'visite_ambulatoriali';
    
    protected $guarded = [];
    
    protected $attributes = [
        'prestazione_id' => null,      
    ];
    
    public function prenotazione() 
    {
        return $this->belongsTo(Prenotazione::class);
    }

    public function paziente() {
        return $this->belongsTo(Paziente::class);
    }

    public function societaSportiva()
    {
        return $this->belongsTo(SocietaSportiva::class , 'societa_id');
    }
    
    public function preAnamnesi() 
    {
        return $this->morphOne(PreAnamnesi::class , 'visita');
    }
    
    public function prestazione()
    {
        return $this->belongsTo(PrestazioneAmbulatoriale::class , 'prestazione_id');
    }

    public function refertoAmbulatoriale() {
        return $this->hasOne(RefertoAmbulatoriale::class , 'visita_id');
    }

    public function refertoCardiologia() {
        return $this->hasOne(RefertoCardiologia::class , 'visita_id');
    }

    public function refertoFisioterapia() {
        return $this->hasOne(RefertoFisioterapia::class , 'visita_id');
    }
}
