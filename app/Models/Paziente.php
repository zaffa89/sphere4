<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paziente extends Model
{
    use HasFactory;

    protected $table = 'pazienti';
    
    protected $guarded = [];    

    

    /*
    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
    */
    
    //attributi di default
    protected $attributes = [                
        'struttura_id' => null,        
        'codice' => null,

        //dati anagrafici
        'nome' => null,
        'cognome' => null,
        'ragione_sociale' => null,
        'sesso' => null,
        'data_nascita' => null,        
        'localita_nascita_id' => null,        
        'codice_fiscale' => null,          

        //contatti e residenza
        'indirizzo' => null,
        'civico' => null,
        'localita_residenza_id' => null,
        'telefono' => null,
        'telefono_fisso' => null,
        'email' => null,
        
        //altro
        'documento' => 3,
        'documento_numero' => null,
        'documento_data_rilascio' => null,
        'documento_localita_rilascio_id' => null,

        'note' => null,
        'gruppo_sanguigno' => null,
        'disabile' => false,
        
        //consensi
        'consenso_privacy' => true,
        'consenso_730' => true,
        'consenso_sms' => true,
        'consenso_email' => true,
    ];
        
    /* RELATIONSHIPS */
    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function ultimaPrenotazione()
    {
        return $this->hasOne(Prenotazione::class)->ofMany()->latestOfMany();
    }

    public function visiteMedsport()
    {
        return $this->hasMany(VisitaMedsport::class);
    }

    public function ultimaVisitaMedsport()
    {
        return $this->hasOne(VisitaMedsport::class)->ofMany()->latestOfMany();
    }

    public function visiteAmbulatoriali() 
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }

    public function ultimaVisitaAmbulatoriale()
    {
        return $this->hasOne(VisitaAmbulatoriale::class)->ofMany()->latestOfMany();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function localitaNascita()
    {
        return $this->belongsTo(Localita::class , 'localita_nascita_id');
    }

    public function localitaResidenza()
    {
        return $this->belongsTo(Localita::class , 'localita_residenza_id');
    }

    public function localitaRilascioDocumento()
    {
        return $this->belongsTo(Localita::class , 'documento_localita_rilascio_id');
    }

    /* MUTATORS */
    protected function ragioneSociale(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected function codiceFiscale(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

}
