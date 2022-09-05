<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prenotazione extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'prenotazioni';
    
    protected $guarded = [];
    
    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function paziente()
    {
        return $this->belongsTo(Paziente::class);
    }

    //prenotazioni di gruppo ???

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function ambulatorio()
    {
        return $this->belongsTo(Ambulatorio::class);
    }

    public function visiteMedsport()
    {
        return $this->hasMany(VisitaMedsport::class); //has many ???
    }

    public function visiteAmbulatoriali()
    {
        return $this->hasMany(VisitaAmbulatoriale::class); //has many ???
    }

    public function visiteCardiologiche()
    {
        return $this->hasMany(VisitaCardiologica::class); //has many ???
    }

    public function visiteFisioterapiche()
    {
        return $this->hasMany(VisitaFisioterapica::class); //has many ???
    }
    
    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}
