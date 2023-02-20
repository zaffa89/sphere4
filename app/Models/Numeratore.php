<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numeratore extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tabella_numeratori';

    public function numeratoreDet() {
        return $this->hasMany(NumeratoreDet::class);
    }    
}
