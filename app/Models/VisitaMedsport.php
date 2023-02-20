<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaMedsport extends Model
{
    use HasFactory;

    protected $table = 'visite_medsport';
    
    protected $guarded = [];
    
    protected $attributes = [
        'listino_id' => null,
        'sport_id' => null,
        'societa_id' => null
    ];

    public function prenotazione() 
    {
        return $this->belongsTo(Prenotazione::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
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

    public function datiClinici()
    {
        return $this->hasOne(DatiCliniciMedsport::class , 'visita_id');
    }

    public function listino()
    {
        return $this->belongsTo(ListinoMedsport::class , 'listino_id');
    }

    public function sport() 
    {
        return $this->belongsTo(Sport::class , 'sport_id');
    }

    protected static function booted() : void 
    {
        static::updating(function( VisitaMedsport $visitaMedsport ) {
                   
        });

        static::updated(function ( VisitaMedsport $visitaMedsport ) {

        });
    }
}