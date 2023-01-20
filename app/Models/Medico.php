<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medici';
    
    protected $guarded = [];
    
    protected $attributes = [
        'user_id' => null,
        'attivo' =>  true,
        'abilitazione_medsport' => true,
        'abilitazione_ambulatoriale' => true,
    ];

    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function orariMedico()
    {
        return $this->hasMany(OrarioMedico::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function visiteMedsport()
    {
        return $this->hasMany(VisitaMedsport::class);
    }

    public function visiteAmbulatoriali()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
