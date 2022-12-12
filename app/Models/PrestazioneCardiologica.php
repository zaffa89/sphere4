<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneCardiologica extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_cardiologiche';
    
    protected $guarded = [];
    
    public function visita()
    {
        return $this->hasMany(VisitaCardiologica::class);
    }
}