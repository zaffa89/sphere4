<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SphereUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function pazientiAperti()
    {
        return $this->morphedByMany(Paziente::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}
