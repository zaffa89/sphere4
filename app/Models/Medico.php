<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medici';
    
    protected $guarded = [];
    
    protected $attributes = [
        'sphere_user_id' => null,
        'attivo' =>  true,
        'abilitazione_medsport' => true,
        'abilitazione_ambulatoriale' => true,
        'abilitazione_cardiologia' => true,
        'abilitazione_fisioterapia' => true,
    ];

    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function orariMedico()
    {
        return $this->hasMany(OrarioMedico::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function sphereUser()
    {
        return $this->belongsTo(SphereUser::class);
    }
}
