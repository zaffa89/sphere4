<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrarioMedico extends Model
{
    use HasFactory;

    protected $table = 'orari_medici';

    protected $guarded = [];

    public function ambulatorio()
    {
        return $this->belongsTo(Ambulatorio::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
