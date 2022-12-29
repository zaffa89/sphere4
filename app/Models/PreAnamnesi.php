<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAnamnesi extends Model
{
    use HasFactory;

    protected $table = "pre_anamnesi";

    protected $guarded = [];

    public function visita()
    {
        return $this->morphTo(__FUNCTION__ , 'visita_type' , 'visita_id');
    }
}
