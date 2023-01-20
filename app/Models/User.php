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

    public function pazienti()
    {
        return $this->hasMany(Paziente::class);
    }

    public function role() 
    {
        return $this->belongsTo(UserRole::class , 'user_role_id');
    }

    public function permessi()
    {
        return $this->belongsToMany(UserPermission::class);
    }

    public function struttura()
    {
        return $this->belongsTo(Struttura::class);
    }
    
    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function visualizzazioniPazienti()
    {
        return $this->morphedByMany(Paziente::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniPrenotazioni()
    {
        return $this->morphedByMany(Prenotazione::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniVisiteMedsport()
    {
        return $this->morphedByMany(VisitaMedsport::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniVisiteAmbulatoriali()
    {
        return $this->morphedByMany(VisitaAmbulatoriale::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniFatture()
    {
        return $this->morphedByMany(Fattura::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
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
        'username'
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

    protected $with = ['permessi'];
}
