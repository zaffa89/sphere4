<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListinoAmbulatoriale extends Model
{
    use HasFactory;

    protected $table = 'listini_ambulatoriali';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaAmbulatoriale::class);
    }
}
