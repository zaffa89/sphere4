<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListinoMedsport extends Model
{
    use HasFactory;

    protected $table = 'listini_medsport';
    
    protected $guarded = [];
    
    public function prestazioni()
    {
        return $this->belongsToMany(PrestazioneMedsport::class , 'listino_prestazione_medsport' , 'listino_medsport_id' , 'prestazione_medsport_id');
    }

    public function visita()
    {
        return $this->hasMany(VisitaMedsport::class);
    }
}
