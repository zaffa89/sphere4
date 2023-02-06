<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SottoprestazioneMedsport extends Model
{
    use HasFactory;

    protected $table = 'sottoprestazioni_medsport';
    
    protected $guarded = [];
    
    public function listini()
    {
        return $this->belongsToMany(ListinoMedsport::class , 'listino_sottoprestazione_medsport' , 'sottoprestazione_medsport_id' , 'listino_medsport_id');
    }
}
