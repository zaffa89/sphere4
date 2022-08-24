<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServizioFisioterapico extends Model
{
    use HasFactory;

    protected $table = 'servizi_fisioterapici';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaFisioterapica::class);
    }
}
