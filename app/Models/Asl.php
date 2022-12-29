<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asl extends Model
{
    use HasFactory;

    protected $table = 'tabella_asl';

    public function localita()
    {
        return $this->hasMany(Localita::class);
    }
}