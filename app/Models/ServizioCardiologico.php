<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServizioCardiologico extends Model
{
    use HasFactory;

    protected $table = 'servizi_cardiologici';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaCardiologica::class);
    }

}
