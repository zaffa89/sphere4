<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneMedsport extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_medsport';
    
    protected $guarded = [];
    
    public function sottoprestazioni()
    {
        return $this->belongsToMany(SottoprestazioneMedsport::class , 'prestazione_sottoprestazione_medsport' , 'prestazione_medsport_id' , 'sottoprestazione_medsport_id');
    }

    public function visita()
    {
        return $this->hasMany(VisitaMedsport::class);
    }
}
