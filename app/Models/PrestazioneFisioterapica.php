<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneFisioterapica extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_fisioterapiche';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaFisioterapica::class);
    }
}
