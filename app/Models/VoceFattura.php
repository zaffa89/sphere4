<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoceFattura extends Model
{
    use HasFactory;

    protected $table = 'voci_fattura';
    
    protected $guarded = [];
    
    public function fattura()
    {
        return $this->belongsTo(Fattura::class);
    }
}
