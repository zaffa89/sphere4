<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneMedsport extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_medsport';
    
    protected $guarded = [];
    
    public function servizioMedsport()
    {
        return $this->belongsToMany(ServizioMedsport::class);
    }
}
