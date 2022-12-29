<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        
        // map polymorphic relationship
        Relation::enforceMorphMap([
            'users' => 'App\Models\User',
            'medsport' => 'App\Models\VisitaMedsport',
            'ambulatoriale' => 'App\Models\VisitaAmbulatoriale',
            'cardiologica' => 'App\Models\VisitaCardiologica',
            'fisioterapica' => 'App\Models\VisitaFisioterapica',
        ]);

        if (Schema::hasTable('settings')) {
            foreach (Setting::all() as $setting) {
                Config::set('settings.'.$setting->attribute, $setting);
            }
        }
    }
}
