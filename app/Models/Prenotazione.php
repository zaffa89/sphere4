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
        'blocco' => false,
        'accettata' => false,
    ];

    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function paziente()
    {
        return $this->belongsTo(Paziente::class);
    }

    public function societaSportiva()
    {
        return $this->belongsTo(SocietaSportiva::class);
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

    public function visita()
    {
        return $this->morphTo(__FUNCTION__ , 'visita_type' , 'visita_id');
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}

/* 379 218 50 41 */