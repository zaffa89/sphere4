<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medici';
    
    protected $guarded = [];
    
    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function sphereUser()
    {
        return $this->belongsTo(SphereUser::class);
    }
}
