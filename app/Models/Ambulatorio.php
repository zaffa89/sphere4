<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulatorio extends Model
{
    use HasFactory;

    protected $table = 'ambulatori';
    
    protected $guarded = [];
    
    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
