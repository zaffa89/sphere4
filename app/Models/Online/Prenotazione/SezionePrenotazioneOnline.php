<?php

namespace App\Models\Online\Prenotazione;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SezionePrenotazioneOnline extends Model
{
    use HasFactory;

    protected $table = 'sezioni_prenotazione_online';

    public function categorie()
    {
        return $this->hasMany(CategoriaPrenotazioneOnline::class);
    }
}
