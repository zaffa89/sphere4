<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaFisioterapica extends Model
{
    use HasFactory;

    protected $table = 'visite_fisioterapiche';
    
    protected $guarded = [];
    
    public function servizio()
    {
        return $this->belongsTo(ServizioFisioterapico::class);
    }

    public function visualizzazioni()
    {
        return $this->morphToMany(SphereUser::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}
