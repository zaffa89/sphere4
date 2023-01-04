<?php

namespace App\Models;


use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prenotazione extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'prenotazioni';
    
    protected $guarded = [];
    
    /*
    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
    */
    
    /* attributi di default */
    protected $attributes = [
        'accettata' => false
    ];

    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }

    public function societaSportiva()
    {
        return $this->belongsTo(SocietaSportiva::class , 'societa_id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function ambulatorio()
    {
        return $this->belongsTo(Ambulatorio::class);
    }

    public function visitaMedsport() 
    {
        return $this->hasOne(VisitaMedsport::class)->latestOfMany();
    }

    public function visitaAmbulatoriale()
    {
        return $this->hasOne(VisitaAmbulatoriale::class)->latestOfMany();
    }

    public function visiteMedsport()
    {
        return $this->hasMany(VisitaMedsport::class);
    }

    public function visiteAmbulatoriali()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }
}