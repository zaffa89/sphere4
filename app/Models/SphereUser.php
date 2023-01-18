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

    public function role() 
    {
        return $this->belongsTo(SphereUserRole::class , 'sphere_user_role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(SphereUserPermission::class , 'sphere_user_permission' , 'sphere_user_id' , 'sphere_user_permission_id')->withTimestamps();
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

    public function visualizzazioniVisiteCardiologiche()
    {
        return $this->morphedByMany(VisitaCardiologica::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniVisiteFisioterapiche()
    {
        return $this->morphedByMany(VisitaFisioterapica::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }

    public function visualizzazioniFatture()
    {
        return $this->morphedByMany(Fattura::class , 'viewable' , 'gdpr_log_views')->withTimestamps();
    }
}
