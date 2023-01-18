<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SphereUserRole extends Model
{
    use HasFactory;

    public function sphereUsers() 
    {
        return $this->hasMany(SphereUser::class , 'sphere_user_role_id');
    }

    public function permissions() 
    {
        return $this->belongsToMany(SphereUserPermission::class , 'sphere_user_role_permission' , 'sphere_user_role_id' , 'sphere_user_permission_id');
    }
}