<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaMedsport extends Model
{
    use HasFactory;

    protected $table = 'visite_medsport';
    
    protected $guarded = [];
    
    public function servizio()
    {
        return $this->belongsTo(ServizioMedsport::class);
    }
}
