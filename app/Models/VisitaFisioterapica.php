<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaFisioterapica extends Model
{
    use HasFactory;

    protected $table = 'visite_fisioterapiche';
    
    protected $guarded = [];
    
    protected $attributes = [
        'prestazione_id' => null,      
    ];

    public function prestazione()
    {
        return $this->belongsTo(PrestazioneFisioterapica::class , 'prestazione_id');
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function prenotazione() 
    {
        return $this->morphOne(Prenotazione::class , 'visita');
    }
}
