<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        /*
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        */

        // GDPR VISUALIZZAZIONE
        \App\Events\PazienteAperto::class => [
            \App\Listeners\LogPazienteAperto::class
        ],
        \App\Events\PrenotazioneAperta::class => [
            \App\Listeners\LogPrenotazioneAperta::class
        ],
        \App\Events\VisitaMedsportAperta::class => [
            \App\Listeners\LogVisitaMedsportAperta::class
        ],
        \App\Events\VisitaAmbulatorialeAperta::class => [
            \App\Listeners\LogVisitaAmbulatorialeAperta::class
        ],
        \App\Events\VisitaCardiologicaAperta::class => [
            \App\Listeners\LogVisitaCardiologicaAperta::class
        ],
        \App\Events\VisitaFisioterapicaAperta::class => [
            \App\Listeners\LogVisitaFisioterapicaAperta::class
        ],
        \App\Events\FatturaAperta::class => [
            \App\Listeners\LogFatturaAperta::class
        ],

        //GDPR MODIFICHE
        \App\Events\PrenotazioneModificata::class => [
            \App\Listeners\LogModificaPrenotazione::class
        ],
        \App\Events\VisitaMedsportModificata::class => [
            \App\Listeners\LogModificaVisitaMedsport::class
        ],
        \App\Events\VisitaAmbulatorialeModificata::class => [
            \App\Listeners\LogModificaVisitaAmbulatoriale::class
        ],
        \App\Events\VisitaCardiologicaModificata::class => [
            \App\Listeners\LogModificaVisitaCardiologica::class
        ],
        \App\Events\VisitaFisioterapicaModificata::class => [
            \App\Listeners\LogModificaVisitaFisioterapica::class
        ],

        //GDPR ELIMINAZIONI
        \App\Events\PrenotazioneEliminata::class => [
            \App\Listeners\LogEliminazionePrenotazione::class
        ],
        
        // ELIMINAZIONE VISITE POSSIBILE ???
        /*
        VisitaMedsportEliminata::class => [
            LogEliminazioneVisitaMedsport::class
        ],
        VisitaAmbulatorialeEliminata::class => [
            LogEliminazioneVisitaAmbulatoriale::class
        ],
        VisitaCardiologicaEliminata::class => [
            LogEliminazioneVisitaCardiologica::class
        ],
        VisitaFisioterapicaEliminata::class => [
            LogEliminazioneVisitaFisioterapica::class
        ]
        */
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}