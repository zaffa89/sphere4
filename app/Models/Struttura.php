<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struttura extends Model
{
    use HasFactory;

    protected $table = 'strutture';

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class , 'struttura_id');
    }
    
    public function ambulatori()
    {
        return $this->hasMany(Ambulatorio::class , 'struttura_id');
    }

    public function orariMedici()
    {
        return $this->hasManyThrough(OrarioMedico::class , Ambulatorio::class , 'struttura_id');
    }

    public function pazienti()
    {
        return $this->hasMany(Paziente::class , 'struttura_id');
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class , 'struttura_id');
    }

    public function numeratori() {
        return $this->hasMany(Numeratore::class , 'struttura_id');
    }

    /* METODI PER NUMERATORI */

    // metodi generici
    public function numeratore($codice , $anno = null) {
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , $codice)->when($anno , function ($query , $anno) { $query->where('anno' , $anno); })->value('valore');
    }

    public function prossimoNumeratore($codice , $anno = null) {
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , $codice)->when($anno , function ($query , $anno) { $query->where('anno' , $anno); })->value('valore') + 1;
    }

    public function incrementaNumeratore($codice , $anno = null) {
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , $codice)->when($anno , function ($query , $anno) { $query->where('anno' , $anno); })->increment('valore' , 1);
    }
    
    public function numeratoreFattura($anno = null) {
        if(!isset($anno)) $anno = now()->year;
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'fattura')->where('anno' , $anno)->value('valore');
    }

    public function prossimoNumeratoreFattura($anno = null) {
        if(!isset($anno)) $anno = now()->year;
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'fattura')->where('anno' , $anno)->value('valore') + 1;
    }

    public function incrementaNumeratoreFattura($anno = null) {
        if(!isset($anno)) $anno = now()->year;
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'fattura')->where('anno' , $anno)->increment('valore' , 1);
    }

    public function numeratoreCertificato() {
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'certificato')->value('valore');
    }

    public function prossimoNumeratoreCertificato($anno = null) {
        if(!isset($anno)) $anno = now()->year;
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'certificato')->value('valore') + 1;
    }

    public function incrementaNumeratoreCertificato($anno = null) {
        if(!isset($anno)) $anno = now()->year;
        return $this->hasOneThrough(NumeratoreDet::class , Numeratore::class)->where('codice' , 'certificato')->increment('valore' , 1);
    }
}