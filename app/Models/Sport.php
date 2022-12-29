<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    use HasFactory;

    protected $table = "tabella_sport";

    protected $guarded = [];

    protected $attributes = [       
        'nome' => null,
        'tipo_visita' => null,
        'codice_sport' => null,
        'codice_federazione' => null,
        'sigla_federazione' => null,
        'mesi_scadenza' => 12,

        'eta_minima_maschi' => null,
        'eta_massima_maschi' => null, 
        'eta_minima_tem_maschi' => null,

        'eta_minima_femmine' => null,
        'eta_massima_femmine' => null,
        'eta_minima_tem_femmine' => null,
        
        'anno_di_riferimento' => null,
        'inizio_anno_riferimento' => '01/07',
        'fine_anno_riferimento' => '31/06',
        
        'disabili' => false,
        'richiesto_gruppo_sanguigno' => false,
        'richiesto_eeg' => false,
        'prenotabile_online' => false,
    ];

    public function visite()
    {
        return $this->hasMany(VisitaMedsport::class);
    }

    /* MUTATORS */
    protected function tipoVisita(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }
}
