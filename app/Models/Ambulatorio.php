<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ambulatorio extends Model
{
    use HasFactory;

    protected $table = 'ambulatori';
    
    protected $guarded = [];
    
    protected $attributes = [
        'nome' => null,
        'struttura_id' => 1, //da fixare
        'ordine' => 1
    ];
    
    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }

    public function orariMedico()
    {
        return $this->hasMany(OrarioMedico::class);
    }

    public function mediciDisponibili()
    {
        return $this->belongsToMany(Medico::class)->withPivot('data_inizio' , 'data_fine')->wherePivot('data_inizio' , '>=' , today());
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
