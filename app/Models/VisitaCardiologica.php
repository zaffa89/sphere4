<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaCardiologica extends Model
{
    use HasFactory;

    protected $table = 'visite_cardiologiche';
    
    protected $guarded = [];
    
    protected $attributes = [
        'prestazione_id' => null,      
    ];
    
    public function prenotazione() 
    {
        return $this->morphOne(Prenotazione::class , 'visita');
    }

    public function preAnamnesi() 
    {
        return $this->morphOne(PreAnamnesi::class , 'visita');
    }
    
    public function prestazione()
    {
        return $this->belongsTo(PrestazioneCardiologica::class , 'prestazione_id');
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    
}
