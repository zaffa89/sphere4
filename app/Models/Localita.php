<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localita extends Model
{
    use HasFactory;

    protected $table = 'tabella_localita';
    
    protected $guarded = [];

    public function pazienti()
    {
        return $this->hasMany(Paziente::class);
    }

    public function asl()
    {
        return $this->belongsTo(Asl::class , 'asl_id');
    }

    public function societaSportive()
    {
        return $this->hasMany(SocietaSportiva::class , 'localita_id');
    }
}
