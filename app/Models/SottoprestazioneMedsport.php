<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SottoprestazioneMedsport extends Model
{
    use HasFactory;

    protected $table = 'sottoprestazioni_medsport';
    
    protected $guarded = [];
    
    public function prestazioni()
    {
        return $this->belongsToMany(PrestazioniMedsport::class , 'prestazione_sottoprestazione_medsport' , 'sottoprestazione_medsport_id' , 'prestazione_medsport_id');
    }
}
