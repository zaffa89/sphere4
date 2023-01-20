<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserPermissionSeeder extends Seeder
{    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* MEDICI */
        UserPermission::create([
            'label' => 'Creazione Medici',
            'description' => 'Permette la creazione di nuovi medici',
            'field' => 'anagrafiche_medici_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza medici',
            'description' => 'Permette la visione dei medici inseriti nel programma',
            'field' => 'anagrafiche_medici_read'
        ]);        

        UserPermission::create([
            'label' => 'Modifica Medici',
            'description' => 'Permette la modifica dei medici inseriti nel programma',
            'field' => 'anagrafiche_medici_update'
        ]);

        UserPermission::create([
            'label' => 'Eliminazione Medici',
            'description' => "Permette l'eliminazione dei medici inseriti nel programma",
            'field' => 'anagrafiche_medici_delete'
        ]);

        /* PAZIENTI */
        UserPermission::create([
            'label' => 'Creazione Pazienti',
            'description' => 'Permette la creazione di nuovi pazienti',
            'field' => 'anagrafiche_pazienti_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza Pazienti',
            'description' => 'Permette la visione dei pazienti inseriti nel programma',
            'field' => 'anagrafiche_pazienti_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Pazienti',
            'description' => 'Permette la modifica dei dati anagrafici dei pazienti inseriti nel programma',
            'field' => 'anagrafiche_pazienti_update'
        ]);

        UserPermission::create([
            'label' => "Elimina Pazienti",
            'description' => 'Permette di eliminare i pazienti inseriti nel programma',
            'field' => 'anagrafiche_pazienti_delete'
        ]);

        /* AMBULATORI */
        UserPermission::create([
            'label' => 'Creazione ambulatori',
            'description' => 'Permette la creazione di nuovi ambulatori',
            'field' => 'anagrafiche_ambulatori_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza ambulatori',
            'description' => 'Permette la visione degli ambulatori inseriti nel programma',
            'field' => 'anagrafiche_ambulatori_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica ambulatori',
            'description' => 'Permette la modifica degli ambulatori inseriti nel programma',
            'field' => 'anagrafiche_ambulatori_update'
        ]);

        UserPermission::create([
            'label' => 'Elimina ambulatori',
            'description' => "Permette di eliminare gli ambulatori inseriti nel programma",
            'field' => 'anagrafiche_ambulatori_delete'
        ]);

        /* SOCIETA' */
        UserPermission::create([
            'label' => 'Creazione Società Sportive / Aziende',
            'description' => 'Permette la creazione di nuove Società Sportive o Aziende',
            'field' => 'anagrafiche_societa_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza Società Sportive / Aziende',
            'description' => 'Permette la visione delle Società Sportive o Aziende inserite nel programma',
            'field' => 'anagrafiche_societa_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Società Sportive / Aziende',
            'description' => 'Permette la modifica delle Società Sportive o Aziende inserite nel programma',
            'field' => 'anagrafiche_societa_update'
        ]);

        UserPermission::create([
            'label' => 'Elimina Società Sportive / Aziende',
            'description' => 'Permette di eliminare le Società Sportive o Aziende inserite nel programma',
            'field' => 'anagrafiche_societa_delete'
        ]);

        /* CALENDARIO */        
        UserPermission::create([
            'label' => 'Visualizza Calendario',
            'description' => 'Permette la visualizzazione del calendario di prenotazione',
            'field' => 'calendario_read'
        ]);

        UserPermission::create([
            'label' => 'Limita calendario al medico',
            'description' => 'Permette la visualizzazione del calendario, limitato ad ambulatori e prenotazioni a lui associate',
            'field' => 'calendario_limita_medico'
        ]);

        /* ORARI MEDICO */
        UserPermission::create([
            'label' => 'Gestione orari medico',
            'description' => 'Permette la gestione della disponibilità oraria dei medici per il calendario',
            'field' => 'gestione_orari_medici'
        ]);

        /* PRENOTAZIONI */
        /* MEDSPORT */
        UserPermission::create([
            'label' => 'Spostamento visite - Medsport',
            'description' => 'Permette di trascinare/ridimensionare le visite di medicina sportiva nel calendario',
            'field' => 'prenotazioni_medsport_drag'
        ]);

        UserPermission::create([
            'label' => 'Creazione Prenotazioni - Medsport',
            'description' => 'Permette la creazione di nuove prenotazioni per la medicina sportiva dal calendario',
            'field' => 'prenotazioni_medsport_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza Prenotazioni - Medsport',
            'description' => 'Permette la visione delle prenotazioni per la medicina sportiva dal calendario',
            'field' => 'prenotazioni_medsport_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Prenotazioni - Medsport',
            'description' => 'Permette la modifica delle prenotazioni per la medicina sportiva dal calendario',
            'field' => 'prenotazioni_medsport_update'
        ]);

        UserPermission::create([
            'label' => 'Elimina Prenotazioni - Medsport',
            'description' => 'Permette di eliminare le prenotazioni per la medicina sportiva dal calendario',
            'field' => 'prenotazioni_medsport_delete'
        ]);

        /* MEDSPORT SOCIETA */
        UserPermission::create([
            'label' => 'Spostamento Prenotazioni - Medsport Società Sportive',
            'description' => 'Permette di trascinare/ridimensionare le prenotazioni delle Società Sportive nel calendario',
            'field' => 'prenotazioni_medsport_societa_drag'
        ]);

        UserPermission::create([
            'label' => 'Creazione Prenotazioni - Medsport Società Sportive',
            'description' => 'Permette di creare nuove prenotazioni per le Società Sportive dal calendario',
            'field' => 'prenotazioni_medsport_societa_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza Prenotazioni - Medsport Società Sportive',
            'description' => 'Permette la visione delle prenotazioni effettuate da Società Sportive dal calendario',
            'field' => 'prenotazioni_medsport_societa_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Prenotazioni - Medsport Società Sportive',
            'description' => 'Permette la modifica delle prenotazioni effettuate da Società Sportive dal calendario',
            'field' => 'prenotazioni_medsport_societa_update'
        ]);

        UserPermission::create([
            'label' => 'Elimina Prenotazioni - Medsport Società Sportive',
            'description' => 'Permette di eliminare le prenotazioni effettuate da Società Sportive dal calendario',
            'field' => 'prenotazioni_medsport_societa_delete'
        ]);

        /* AMBULATORIALE */
        UserPermission::create([
            'label' => 'Spostamento Prenotazioni - Ambulatoriale',
            'description' => 'Permette di trascinare/ridimensionare le prenotazioni ambulatoriali dal calendario',
            'field' => 'prenotazioni_ambulatoriali_drag'
        ]);

        UserPermission::create([
            'label' => 'Creazione Prenotazioni - Ambulatoriale',
            'description' => 'Permette la creazione di nuove prenotazioni ambulatoriali dal calendario',
            'field' => 'prenotazioni_ambulatoriali_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza Prenotazioni - Ambulatoriale',
            'description' => 'Permette la visione delle prenotazioni ambulatoriali dal calendario',
            'field' => 'prenotazioni_ambulatoriali_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Prenotazioni - Ambulatoriale',
            'description' => 'Permette la modifica di prenotazioni ambulatoriali dal calendario',
            'field' => 'prenotazioni_ambulatoriali_update'
        ]);

        UserPermission::create([
            'label' => 'Eliminazione Prenotazioni - Ambulatoriale',
            'description' => 'Permette di eliminare le prenotazioni ambulatoriali dal calendario',
            'field' => 'prenotazioni_ambulatoriali_delete'
        ]);

        /* AMBULATORIALE SOCIETA */
        UserPermission::create([
            'label' => 'Spostamento Prenotazioni - Ambulatoriale Società Sportive / Aziende',
            'description' => 'Permette di trascinare/ridimensionare le prenotazioni ambulatoriali effettuate da Società Sportive/Aziende dal calendario',
            'field' => 'prenotazioni_ambulatoriali_societa_drag'
        ]);

        UserPermission::create([
            'label' => 'Creazione Prenotazioni - Ambulatoriale Società Sportive/Aziende',
            'description' => 'Permette di creare nuove prenotazioni ambulatoriali per Società Sportive/Aziende dal calendario',
            'field' => 'prenotazioni_ambulatoriali_societa_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizzazione Prenotazioni - Ambulatoriale Società Sportive/Aziende',
            'description' => 'Permette la visione delle prenotazioni ambulatoriali effettuate da Società Sportive/Aziende dal calendario',
            'field' => 'prenotazioni_ambulatoriali_societa_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica Prenotazioni - Ambulatoriale Società Sportive/Aziende',
            'description' => 'Permette di modificare le prenotazioni ambulatoriali effettuate da Società Sportive/Aziende dal calendario',
            'field' => 'prenotazioni_ambulatoriali_societa_update'
        ]);

        UserPermission::create([
            'label' => 'Elimina Prenotazioni - Ambulatoriale Società Sportive/Aziende',
            'description' => 'Permette di eliminare prenotazioni ambulatoriali effettuate da Società Sportive/Aziende dal calendario',
            'field' => 'prenotazioni_ambulatoriali_societa_delete'
        ]);
        

        /* ACCETTAZIONE */
        UserPermission::create([
            'label' => 'Accettazione Medsport',
            'description' => 'Accesso alla schermata di accettazione per le visite Medsport',
            'field' => 'accettazione_medsport'
        ]);
        
        UserPermission::create([
            'label' => 'Accettazione Ambulatoriale',
            'description' => 'Accesso alla schermata di accettazione per le visite ambulatoriali',
            'field' => 'accettazione_ambulatoriale'
        ]);

        /* VISITE MEDSPORT */        
        UserPermission::create([
            'label' => 'Creazione visite Medsport',
            'description' => 'Permette la creazione di visite Medsport in accettazione',
            'field' => 'visite_medsport_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza visite Medsport',
            'description' => 'Permette la visione delle visite Medsport in accettazione',
            'field' => 'visite_medsport_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica visite Medsport',
            'description' => 'Permette la modifica delle visite Medsport in accettazione ( ad accezione dei dati medici: vedi sotto )',
            'field' => 'visite_medsport_update'
        ]);

        UserPermission::create([
            'label' => 'Eliminazione visite',
            'description' => 'Permette di eliminare le visita Medsport in accettazione',
            'field' => 'visite_medsport_delete'
        ]);

        UserPermission::create([
            'label' => 'Filtro visite Medsport per medico',
            'description' => 'Mostra al medico solo le visite a cui è stato assegnato come medico esecutore',
            'field' => 'visite_medsport_medico'
        ]);

        /* PREANAMNESI MEDSPORT */
        UserPermission::create([
            'label' => 'Visualizza preanamnesi medsport',
            'description' => 'Permette la visione della preanamnesi nelle visite Medsport',
            'field' => 'visite_medsport_preanamnesi_update'
        ]);

        UserPermission::create([
            'label' => 'Modifica preanamnesi medsport',
            'description' => 'Permette la modifica della preanamnesi nelle visite Medsport',
            'field' => 'visite_medsport_preanamnesi_update'
        ]);

        /* DATI CLINICI MEDSPORT */
        UserPermission::create([
            'label' => 'Visualizza dati clinici Medsport',
            'description' => 'Permette la visione dei dati clinici nelle visite Medsport',
            'field' => 'visite_medsport_dati_clinici_update'
        ]);

        UserPermission::create([
            'label' => 'Modifica dati clinici Medsport',
            'description' => 'Permette la modifica dei dati clinici nelle visite Medsport',
            'field' => 'visite_medsport_dati_clinici_update'
        ]);


        /* VISITE AMBULATORIALI */
        UserPermission::create([
            'label' => 'Creazione visite - Ambulatoriale',
            'description' => 'Permette la creazione di visite Ambulatoriali in accettazione',
            'field' => 'visite_ambulatoriali_create'
        ]);

        UserPermission::create([
            'label' => 'Visualizza visite - Ambulatoriale',
            'description' => 'Permette la visione delle visite Ambulatoriali in accettazione',
            'field' => 'visite_ambulatoriali_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica visite - Ambulatoriale',
            'description' => 'Permette la modifica delle visite Ambulatoriali in accettazione ( ad accezione dei dati medici: vedi sotto )',
            'field' => 'visite_ambulatoriali_update'
        ]);

        UserPermission::create([
            'label' => 'Eliminazione visite - Ambulatoriale',
            'description' => "Permette l'eliminazione di una visita Ambulatoriale in accettazione",
            'field' => 'visite_ambulatoriali_delete'
        ]);

        UserPermission::create([
            'label' => 'Filtro visite ambulatoriali per medico',
            'description' => 'Mostra al medico solo le visite ambulatoriali a cui è stato assegnato come medico esecutore',
            'field' => 'visite_ambulatoriali_medico'
        ]);

        /* PREANAMNESI MEDSPORT */
        UserPermission::create([
            'label' => 'Visualizza preanamnesi Ambulatoriale',
            'description' => 'Permette la visione della preanamnesi nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_preanamnesi_update'
        ]);

        UserPermission::create([
            'label' => 'Modifica preanamnesi Ambulatoriale',
            'description' => 'Permette la modifica della preanamnesi nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_preanamnesi_update'
        ]);

        /* DATI CLINICI MEDSPORT */
        UserPermission::create([
            'label' => 'Visualizza referto Ambulatoriale',
            'description' => 'Permette la visione del referto ambulatoriale nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_ambu_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica referto Ambulatoriale',
            'description' => 'Permette la modifica del referto ambulatoriale nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_ambu_update'
        ]);

        UserPermission::create([
            'label' => 'Visualizza referto - Cardiologia',
            'description' => 'Permette la visione del referto di Cardiologia nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_cardio_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica referto - Cardiologia',
            'description' => 'Permette la modifica del referto di Cardiologia nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_cardio_update'
        ]);

        UserPermission::create([
            'label' => 'Visualizza referto - Fisioterapia',
            'description' => 'Permette la visione del referto di Fisioterapia nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_fisio_read'
        ]);

        UserPermission::create([
            'label' => 'Modifica referto Ambulatoriale',
            'description' => 'Permette la modifica del referto di Fisioterapia nelle visite Ambulatoriali',
            'field' => 'visite_ambulatoriali_referto_fisio_update'
        ]);

        /* ESPORTAZIONI */
        UserPermission::create([
            'label' => 'Generazione Dischetto Regione',
            'description' => 'Permette la generazione del dischetto',
            'field' => 'dischetto_regione'
        ]);

        UserPermission::create([
            'label' => 'Precompilato 730',
            'description' => 'Permette la generazione del precompilato 730',
            'field' => 'precompilato_730'
        ]);

        /* GESTIONE */                
        UserPermission::create([
            'label' => 'Identificatori',
            'description' => 'Accesso alla gestione degli identificatori',
            'field' => 'gestione_identificatori'
        ]);

        UserPermission::create([
            'label' => 'Gestione Budget ASL',
            'description' => 'Accesso alla gestione del Budget ASL',
            'field' => 'gestione_budget_asl'
        ]);

        UserPermission::create([
            'label' => 'Gestione Listino Visite',
            'description' => 'Accesso alla gestione del listino visite e prestazioni',
            'field' => 'gestione_listino_visite'
        ]);

        UserPermission::create([
            'label' => 'Fatturazione',
            'description' => 'Accesso alla fatturazione',
            'field' => 'gestione_fatture'
        ]);

        UserPermission::create([
            'label' => 'Compensi Medici',
            'description' => 'Accesso alla gestione dei compensi medici',
            'field' => 'gestione_compensi_medici'
        ]);

        UserPermission::create([
            'label' => 'Impostazioni Sport',
            'description' => 'Accesso alla gestione degli sport',
            'field' => 'gestione_sport'
        ]);
    }
}
