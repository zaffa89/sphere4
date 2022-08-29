<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struttura extends Model
{
    use HasFactory;

    protected $table = 'strutture';

    protected $guarded = [];

    public function ambulatori()
    {
        return $this->hasMany(Ambulatorio::class , 'struttura_id');
    }

    public function medici()
    {
        return $this->hasMany(Medico::class , 'struttura_id');
    }

    public function pazienti()
    {
        return $this->hasMany(Paziente::class , 'struttura_id');
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
