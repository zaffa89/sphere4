<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paziente extends Model
{
    use HasFactory;

    protected $table = 'pazienti';
    
    protected $guarded = [];
    
    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function ultimaPrenotazione()
    {
        return $this->hasOne(Prenotazione::class)->ofMany()->latestOfMany();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
