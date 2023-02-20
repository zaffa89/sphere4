<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoricoPrenotazione extends Model
{
    use HasFactory;

    protected $table = 'storico_prenotazioni';
    
    protected $guarded = [];

    public function prenotazione() {
        return $this->belongsTo(Prenotazione::class);
    }
}
