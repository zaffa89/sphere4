<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestazioneMedsport extends Model
{
    use HasFactory;

    protected $table = 'prestazioni_medsport';
    
    protected $guarded = [];
    
    public function listini()
    {
        return $this->belongsToMany(ListinoMedsport::class , 'listino_prestazione_medsport' , 'prestazione_medsport_id' , 'listino_medsport_id');
    }
}
