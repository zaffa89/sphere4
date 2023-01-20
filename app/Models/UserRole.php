<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public function users() 
    {
        return $this->hasMany(User::class , 'user_role_id');
    }

    public function permessi() 
    {
        return $this->belongsToMany(UserPermission::class , 'user_role_permission' , 'user_role_id' , 'user_permission_id');
    }
}