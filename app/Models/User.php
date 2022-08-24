<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasApiTokens;

    public function utentiSphere()
    {
        return $this->hasMany(SphereUser::class);
    }

    public function utenteSphere()
    {
        return $this->hasOne(SphereUser::class)->where('token_id' , $this->currentAccessToken()->id);
    }

    public function getUsernameAttribute()
    {
        return SphereUser::where('token_id' , $this->currentAccessToken()->id)->value('username');
    }

   

    public function pazienti()
    {
        return $this->hasMany(Paziente::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'telefono',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
