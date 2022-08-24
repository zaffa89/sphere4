<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

class SphereUser extends Model
{
    use HasFactory;

    protected $hidden = ['password'];
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
