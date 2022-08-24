<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fattura extends Model
{
    use HasFactory;

    protected $table = 'fatture';
    
    protected $guarded = [];
    
    public function vociFattura()
    {
        return $this->hasMany(VoceFattura::class);
    }
    
}
