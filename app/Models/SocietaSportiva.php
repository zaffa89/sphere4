<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietaSportiva extends Model
{
    use HasFactory;

    protected $table = "societa_sportive";

    protected $guarded = [];

    protected $attributes = [
        'ragione_sociale' => null,
        'indirizzo' => null,
        'civico' => null,

        'localita_id' => null,

        'telefono' => null,
        'email' => null,

        'responsabile' => null,
        'responsabile_telefono' => null,
        'responsabile_email' => null,

        'presidente' => null,
        'presidente_telefono' => null,
        'presidente_email' => null,

        'partita_iva' => null,
        'codice_fiscale' => null,
        
        'codice_destinatario' => null,
        'pec' => null,
        'codice_nazione' => null,
    ];

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function pazienti()
    {
        return $this->hasManyThrough(Paziente::class , Prenotazione::class , 'paziente_id');
    }

    public function localita() {
        return $this->belongsTo(Localita::class);
    }
}
