<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* CALENDARIO */
        Setting::create([
            'attribute' => 'colore_prenotazione_medsport',
            'value' => '#FFFFFF',
            'description' => 'Colore di default per le prenotazioni Medsport',
            'category' => 'calendario'
        ]);

        Setting::create([
            'attribute' => 'colore_prenotazione_ambulatoriale',
            'value' => '#FFFFFF',
            'description' => 'Colore di default per le prenotazioni ambulatoriali',
            'category' => 'calendario'
        ]);

        Setting::create([
            'attribute' => 'colore_prenotazione_cardiologia',
            'value' => '#FFFFFF',
            'description' => 'Colore di default per le prenotazioni di cardiologia',
            'category' => 'calendario'
        ]);

        Setting::create([
            'attribute' => 'colore_prenotazione_fisioterapia',
            'value' => '#FFFFFF',
            'description' => 'Colore di default per le prenotazioni di fisioterapia',
            'category' => 'calendario'
        ]);
        
        Setting::create([
            'attribute' => 'ora_minima_calendario',
            'value' => 7,
            'description' => 'Orario minimo del calendario',
            'category' => 'calendario'
        ]);

        Setting::create([
            'attribute' => 'ora_massima_calendario',
            'value' => 21,
            'description' => 'Orario massimo del calendario',
            'category' => 'calendario'
        ]);

        Setting::create([
            'attribute' => 'durata_cella_calendario',
            'value' => 15,
            'description' => 'Durata celle del calendario',
            'category' => 'calendario'
        ]);

        /* NOTIFICHE */

        /* **** MAIL */
        Setting::create([
            'attribute' => 'mail_promemoria_appuntamento_flag',
            'value' => 1,
            'description' => 'Flag per invio email di promemoria appuntamento',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'mail_promemoria_appuntamento_margine',
            'value' => 24,
            'description' => 'Margine di invio per email di promemoria appuntamento ( in ore )',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'mail_scadenza_certificato_flag',
            'value' => 1,
            'description' => 'Flag per invio email di avviso scadenza certificato',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'mail_scadenza_certificato_margine',
            'value' => 30,
            'description' => 'Margine di invio per email di avviso scadenza certificato ( in giorni )',
            'category' => 'notifiche'
        ]);        

        Setting::create([
            'attribute' => 'mail_avvenuta_prenotazione_flag',
            'value' => 1,
            'description' => 'Flag per invio email di avvenuta prenotazione',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'mail_avvenuta_prenotazione_documentazione_flag',
            'value' => 1,
            'description' => 'Flag per invio email di richiesta documentazione compilabile online',
            'category' => 'notifiche'
        ]);

        /* **** SMS */
        Setting::create([
            'attribute' => 'sms_avvenuta_prenotazione_flag',
            'value' => 1,
            'description' => 'Flag per invio SMS di avvenuta prenotazione',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'sms_promemoria_appuntamento_flag',
            'value' => 1,
            'description' => 'Flag per invio SMS di promemoria appuntamento',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'sms_promemoria_appuntamento_margine',
            'value' => 24,
            'description' => 'Margine di invio per SMS di promemoria appuntamento ( in ore )',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'sms_scadenza_certificato_flag',
            'value' => 1,
            'description' => 'Flag per invio SMS di avviso scadenza certificato',
            'category' => 'notifiche'
        ]);

        Setting::create([
            'attribute' => 'sms_scadenza_certificato_margine',
            'value' => 30,
            'description' => 'Margine di invio per SMS di avviso scadenza certificato ( in giorni )',
            'category' => 'notifiche'
        ]);  
        
        
    }
}
