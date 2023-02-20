<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Str;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $user = User::create([
            'email' => 'assistenza@solutionmed.it',
            'email_verified_at' => now(),
            'username' => 'solutionmed',
            'telefono' => '0000000000',
            'admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'attivo' => true,
            'struttura_id' => 1
        ]);

        $user->permessi()->create([
            //MEDICI
            'anagrafiche_medici_create' => true,
            'anagrafiche_medici_read' => true,
            'anagrafiche_medici_update' => true,
            'anagrafiche_medici_delete' => true,

            //PAZIENTI
            'anagrafiche_pazienti_create' => true,
            'anagrafiche_pazienti_read' => true,
            'anagrafiche_pazienti_update' => true,
            'anagrafiche_pazienti_delete' => true,

            //AMBULATORI
            'anagrafiche_ambulatori_create' => true,
            'anagrafiche_ambulatori_read' => true,
            'anagrafiche_ambulatori_update' => true,
            'anagrafiche_ambulatori_delete' => true,

            //SOCIETA'
            'anagrafiche_societa_create' => true,
            'anagrafiche_societa_read' => true,
            'anagrafiche_societa_update' => true,
            'anagrafiche_societa_delete' => true,

            //CALENDARIO
            'calendario_read' => true,
            'calendario_limita_medico' => false, //Permette la visualizzazione del calendario, limitato ad ambulatori e prenotazioni a lui associate

            //ORARI MEDICO
            'gestione_orari_medici' => true,

            //PRENOTAZIONI MEDSPORT
            'prenotazioni_medsport_drag' => true,
            'prenotazioni_medsport_create' => true,
            'prenotazioni_medsport_read' => true,
            'prenotazioni_medsport_update' => true,
            'prenotazioni_medsport_delete' => true,

            //PRENOTAZIONI MEDSPORT SOCIETA'
            'prenotazioni_medsport_societa_drag' => true,
            'prenotazioni_medsport_societa_create' => true,
            'prenotazioni_medsport_societa_read' => true,
            'prenotazioni_medsport_societa_update' => true,
            'prenotazioni_medsport_societa_delete' => true,

            //PRENOTAZIONI AMBULATORIALI
            'prenotazioni_ambulatoriali_drag' => true,
            'prenotazioni_ambulatoriali_create' => true,
            'prenotazioni_ambulatoriali_read' => true,
            'prenotazioni_ambulatoriali_update' => true,
            'prenotazioni_ambulatoriali_delete' => true,

            //PRENOTAZIONI AMBULATORIALI SOCIETA'
            'prenotazioni_ambulatoriali_societa_drag' => true,
            'prenotazioni_ambulatoriali_societa_create' => true,
            'prenotazioni_ambulatoriali_societa_read' => true,
            'prenotazioni_ambulatoriali_societa_update' => true,
            'prenotazioni_ambulatoriali_societa_delete' => true,

            //ACCETTAZIONE E VISITE MEDSPORT
            'accettazione_medsport_view' => true,

            'visite_medsport_create' => true,
            'visite_medsport_read' => true,
            'visite_medsport_update' => true,
            'visite_medsport_delete' => true,

            'visite_medsport_medico' => false, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI MEDSPORT
            'visite_medsport_preanamnesi_read' => true,
            'visite_medsport_preanamnesi_update' => true,

            //DATI CLINICI MEDSPORT
            'visite_medsport_dati_clinici_read' => true,
            'visite_medsport_dati_clinici_update' => true,

            //ACCETTAZIONE E VISITE AMBULATORIALI           
            'accettazione_ambulatoriale_view' => true,
            'visite_ambulatoriali_create' => true,
            'visite_ambulatoriali_read' => true,
            'visite_ambulatoriali_update' => true,
            'visite_ambulatoriali_delete' => true,

            'visite_ambulatoriali_medico' => false, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI AMBULATORIALE
            'visite_ambulatoriali_preanamnesi_read' => true,
            'visite_ambulatoriali_preanamnesi_update' => true,

            //REFERTI AMBULATORIALI
            'visite_ambulatoriali_referto_ambu_read' => true,
            'visite_ambulatoriali_referto_ambu_update' => true,

            'visite_ambulatoriali_referto_cardio_read' => true,
            'visite_ambulatoriali_referto_cardio_update' => true,

            'visite_ambulatoriali_referto_fisio_read' => true,
            'visite_ambulatoriali_referto_fisio_update' => true,

            //CONTABILITA' ( DA VEDERE )
            'gestione_fatture' => true,
            'gestione_compensi_medici' => true,

            //ESPORTAZIONI
            'dischetto_regione' => true,
            'precompilato_730' => true,

            //GESTIONE
            'gestione_identificatori' => true,
            'gestione_budget_asl' => true,
            'gestione_listino_visite_medsport' => true,
            'gestione_listino_visite_ambulatoriali' => true,
            'gestione_sport' => true,
        ]);
        
        $user = User::create([
            'email' => 'segreteria@solutionmed.it',
            'email_verified_at' => now(),
            'username' => 'segreteria',
            'telefono' => '3668223564',          
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10), 
            'attivo' => true,
            'struttura_id' => 1           
        ]);

        $user->permessi()->create([
            //MEDICI
            'anagrafiche_medici_create' => true,
            'anagrafiche_medici_read' => true,
            'anagrafiche_medici_update' => true,
            'anagrafiche_medici_delete' => true,

            //PAZIENTI
            'anagrafiche_pazienti_create' => true,
            'anagrafiche_pazienti_read' => true,
            'anagrafiche_pazienti_update' => true,
            'anagrafiche_pazienti_delete' => true,

            //AMBULATORI
            'anagrafiche_ambulatori_create' => true,
            'anagrafiche_ambulatori_read' => true,
            'anagrafiche_ambulatori_update' => true,
            'anagrafiche_ambulatori_delete' => true,

            //SOCIETA'
            'anagrafiche_societa_create' => true,
            'anagrafiche_societa_read' => true,
            'anagrafiche_societa_update' => true,
            'anagrafiche_societa_delete' => true,

            //CALENDARIO
            'calendario_read' => true,
            'calendario_limita_medico' => false, //Permette la visualizzazione del calendario, limitato ad ambulatori e prenotazioni a lui associate

            //ORARI MEDICO
            'gestione_orari_medici' => true,

            //PRENOTAZIONI MEDSPORT
            'prenotazioni_medsport_drag' => true,
            'prenotazioni_medsport_create' => true,
            'prenotazioni_medsport_read' => true,
            'prenotazioni_medsport_update' => true,
            'prenotazioni_medsport_delete' => true,

            //PRENOTAZIONI MEDSPORT SOCIETA'
            'prenotazioni_medsport_societa_drag' => true,
            'prenotazioni_medsport_societa_create' => true,
            'prenotazioni_medsport_societa_read' => true,
            'prenotazioni_medsport_societa_update' => true,
            'prenotazioni_medsport_societa_delete' => true,

            //PRENOTAZIONI AMBULATORIALI
            'prenotazioni_ambulatoriali_drag' => true,
            'prenotazioni_ambulatoriali_create' => true,
            'prenotazioni_ambulatoriali_read' => true,
            'prenotazioni_ambulatoriali_update' => true,
            'prenotazioni_ambulatoriali_delete' => true,

            //PRENOTAZIONI AMBULATORIALI SOCIETA'
            'prenotazioni_ambulatoriali_societa_drag' => true,
            'prenotazioni_ambulatoriali_societa_create' => true,
            'prenotazioni_ambulatoriali_societa_read' => true,
            'prenotazioni_ambulatoriali_societa_update' => true,
            'prenotazioni_ambulatoriali_societa_delete' => true,

            //ACCETTAZIONE E VISITE MEDSPORT
            'accettazione_medsport_view' => true,

            'visite_medsport_create' => true,
            'visite_medsport_read' => true,
            'visite_medsport_update' => true,
            'visite_medsport_delete' => true,

            'visite_medsport_medico' => false, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI MEDSPORT
            'visite_medsport_preanamnesi_read' => true,
            'visite_medsport_preanamnesi_update' => false,

            //DATI CLINICI MEDSPORT
            'visite_medsport_dati_clinici_read' => true,
            'visite_medsport_dati_clinici_update' => false,

            //ACCETTAZIONE E VISITE AMBULATORIALI           
            'accettazione_ambulatoriale_view' => true,
            'visite_ambulatoriali_create' => true,
            'visite_ambulatoriali_read' => true,
            'visite_ambulatoriali_update' => true,
            'visite_ambulatoriali_delete' => true,

            'visite_ambulatoriali_medico' => false, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI AMBULATORIALE
            'visite_ambulatoriali_preanamnesi_read' => true,
            'visite_ambulatoriali_preanamnesi_update' => false,

            //REFERTI AMBULATORIALI
            'visite_ambulatoriali_referto_ambu_read' => true,
            'visite_ambulatoriali_referto_ambu_update' => false,

            'visite_ambulatoriali_referto_cardio_read' => true,
            'visite_ambulatoriali_referto_cardio_update' => false,

            'visite_ambulatoriali_referto_fisio_read' => true,
            'visite_ambulatoriali_referto_fisio_update' => false,

            //CONTABILITA' ( DA VEDERE )
            'gestione_fatture' => true,
            'gestione_compensi_medici' => true,

            //ESPORTAZIONI
            'dischetto_regione' => true,
            'precompilato_730' => true,

            //GESTIONE
            'gestione_identificatori' => true,
            'gestione_budget_asl' => true,
            'gestione_listino_visite_medsport' => true,
            'gestione_listino_visite_ambulatoriali' => true,
            'gestione_sport' => true,
        ]);

        $user = User::create([
            'email' => 'medico@solutionmed.it',
            'email_verified_at' => now(),
            'username' => 'medico',
            'telefono' => '3668223564',            
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10), 
            'attivo' => true,
            'struttura_id' => 1           
        ]);
       
        $user->permessi()->create([
            //MEDICI
            'anagrafiche_medici_create' => false,
            'anagrafiche_medici_read' => true,
            'anagrafiche_medici_update' => false,
            'anagrafiche_medici_delete' => false,

            //PAZIENTI
            'anagrafiche_pazienti_create' => false,
            'anagrafiche_pazienti_read' => true,
            'anagrafiche_pazienti_update' => false,
            'anagrafiche_pazienti_delete' => false,

            //AMBULATORI
            'anagrafiche_ambulatori_create' => false,
            'anagrafiche_ambulatori_read' => true,
            'anagrafiche_ambulatori_update' => false,
            'anagrafiche_ambulatori_delete' => false,

            //SOCIETA'
            'anagrafiche_societa_create' => false,
            'anagrafiche_societa_read' => true,
            'anagrafiche_societa_update' => false,
            'anagrafiche_societa_delete' => false,

            //CALENDARIO
            'calendario_read' => true,
            'calendario_limita_medico' => true, //Permette la visualizzazione del calendario, limitato ad ambulatori e prenotazioni a lui associate

            //ORARI MEDICO
            'gestione_orari_medici' => false,

            //PRENOTAZIONI MEDSPORT
            'prenotazioni_medsport_drag' => false,
            'prenotazioni_medsport_create' => false,
            'prenotazioni_medsport_read' => true,
            'prenotazioni_medsport_update' => false,
            'prenotazioni_medsport_delete' => false,

            //PRENOTAZIONI MEDSPORT SOCIETA'
            'prenotazioni_medsport_societa_drag' => false,
            'prenotazioni_medsport_societa_create' => false,
            'prenotazioni_medsport_societa_read' => true,
            'prenotazioni_medsport_societa_update' => false,
            'prenotazioni_medsport_societa_delete' => false,

            //PRENOTAZIONI AMBULATORIALI
            'prenotazioni_ambulatoriali_drag' => false,
            'prenotazioni_ambulatoriali_create' => false,
            'prenotazioni_ambulatoriali_read' => true,
            'prenotazioni_ambulatoriali_update' => false,
            'prenotazioni_ambulatoriali_delete' => false,

            //PRENOTAZIONI AMBULATORIALI SOCIETA'
            'prenotazioni_ambulatoriali_societa_drag' => false,
            'prenotazioni_ambulatoriali_societa_create' => false,
            'prenotazioni_ambulatoriali_societa_read' => true,
            'prenotazioni_ambulatoriali_societa_update' => false,
            'prenotazioni_ambulatoriali_societa_delete' => false,

            //ACCETTAZIONE E VISITE MEDSPORT
            'accettazione_medsport_view' => true,

            'visite_medsport_create' => false,
            'visite_medsport_read' => true,
            'visite_medsport_update' => true,
            'visite_medsport_delete' => false,

            'visite_medsport_medico' => true, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI MEDSPORT
            'visite_medsport_preanamnesi_read' => true,
            'visite_medsport_preanamnesi_update' => true,

            //DATI CLINICI MEDSPORT
            'visite_medsport_dati_clinici_read' => true,
            'visite_medsport_dati_clinici_update' => true,

            //ACCETTAZIONE E VISITE AMBULATORIALI           
            'accettazione_ambulatoriale_view' => true,
            'visite_ambulatoriali_create' => false,
            'visite_ambulatoriali_read' => true,
            'visite_ambulatoriali_update' => true,
            'visite_ambulatoriali_delete' => false,

            'visite_ambulatoriali_medico' => true, //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI AMBULATORIALE
            'visite_ambulatoriali_preanamnesi_read' => true,
            'visite_ambulatoriali_preanamnesi_update' => true,

            //REFERTI AMBULATORIALI
            'visite_ambulatoriali_referto_ambu_read' => true,
            'visite_ambulatoriali_referto_ambu_update' => true,

            'visite_ambulatoriali_referto_cardio_read' => true,
            'visite_ambulatoriali_referto_cardio_update' => true,

            'visite_ambulatoriali_referto_fisio_read' => true,
            'visite_ambulatoriali_referto_fisio_update' => true,

            //CONTABILITA' ( DA VEDERE )
            'gestione_fatture' => false,
            'gestione_compensi_medici' => false,

            //ESPORTAZIONI
            'dischetto_regione' => false,
            'precompilato_730' => true,

            //GESTIONE
            'gestione_identificatori' => false,
            'gestione_budget_asl' => false,
            'gestione_listino_visite_medsport' => false,
            'gestione_listino_visite_ambulatoriali' => false,
            'gestione_sport' => false,
        ]);
    }
}