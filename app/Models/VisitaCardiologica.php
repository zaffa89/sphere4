<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaCardiologica extends Model
{
    use HasFactory;

    protected $table = 'visite_cardiologiche';
    
    protected $guarded = [];
    
    public function servizio()
    {
        return $this->belongsTo(ServizioCardiologico::class);
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}
