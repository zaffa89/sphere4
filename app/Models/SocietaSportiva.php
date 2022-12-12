<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietaSportiva extends Model
{
    use HasFactory;

    protected $table = "societa_sportive";

    protected $guarded = [];

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function pazienti()
    {
        return $this->hasManyThrough(Paziente::class , Prenotazione::class , 'paziente_id');
    }
}
