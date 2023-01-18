<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SphereUserPermission extends Model
{
    use HasFactory;

    public function sphereUser()
    {
        return $this->belongsToMany(SphereUser::class);
    }
}
