<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServizioMedsport extends Model
{
    use HasFactory;

    protected $table = 'servizi_medsport';
    
    protected $guarded = [];
    
    public function prestazioneMedsport()
    {
        return $this->belongsToMany(PrestazioneMedsport::class);
    }

    public function visita()
    {
        return $this->hasMany(VisitaMedsport::class);
    }
}
