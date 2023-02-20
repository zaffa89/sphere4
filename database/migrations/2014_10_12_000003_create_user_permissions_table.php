<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            //MEDICI
            $table->boolean('anagrafiche_medici_create')->default(false);
            $table->boolean('anagrafiche_medici_read')->default(false);
            $table->boolean('anagrafiche_medici_update')->default(false);
            $table->boolean('anagrafiche_medici_delete')->default(false);

            //PAZIENTI
            $table->boolean('anagrafiche_pazienti_create')->default(false);
            $table->boolean('anagrafiche_pazienti_read')->default(false);
            $table->boolean('anagrafiche_pazienti_update')->default(false);
            $table->boolean('anagrafiche_pazienti_delete')->default(false);

            //AMBULATORI
            $table->boolean('anagrafiche_ambulatori_create')->default(false);
            $table->boolean('anagrafiche_ambulatori_read')->default(false);
            $table->boolean('anagrafiche_ambulatori_update')->default(false);
            $table->boolean('anagrafiche_ambulatori_delete')->default(false);

            //SOCIETA'
            $table->boolean('anagrafiche_societa_create')->default(false);
            $table->boolean('anagrafiche_societa_read')->default(false);
            $table->boolean('anagrafiche_societa_update')->default(false);
            $table->boolean('anagrafiche_societa_delete')->default(false);

            //CALENDARIO
            $table->boolean('calendario_read')->default(false);
            $table->boolean('calendario_limita_medico')->default(false); //Permette la visualizzazione del calendario, limitato ad ambulatori e prenotazioni a lui associate

            //ORARI MEDICO
            $table->boolean('gestione_orari_medici')->default(false);

            //PRENOTAZIONI MEDSPORT
            $table->boolean('prenotazioni_medsport_drag')->default(false);
            $table->boolean('prenotazioni_medsport_create')->default(false);
            $table->boolean('prenotazioni_medsport_read')->default(false);
            $table->boolean('prenotazioni_medsport_update')->default(false);
            $table->boolean('prenotazioni_medsport_delete')->default(false);

            //PRENOTAZIONI MEDSPORT SOCIETA'
            $table->boolean('prenotazioni_medsport_societa_drag')->default(false);
            $table->boolean('prenotazioni_medsport_societa_create')->default(false);
            $table->boolean('prenotazioni_medsport_societa_read')->default(false);
            $table->boolean('prenotazioni_medsport_societa_update')->default(false);
            $table->boolean('prenotazioni_medsport_societa_delete')->default(false);

            //PRENOTAZIONI AMBULATORIALI
            $table->boolean('prenotazioni_ambulatoriali_drag')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_create')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_read')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_update')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_delete')->default(false);

            //PRENOTAZIONI AMBULATORIALI SOCIETA'
            $table->boolean('prenotazioni_ambulatoriali_societa_drag')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_societa_create')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_societa_read')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_societa_update')->default(false);
            $table->boolean('prenotazioni_ambulatoriali_societa_delete')->default(false);

            //ACCETTAZIONE E VISITE MEDSPORT
            $table->boolean('accettazione_medsport_view')->default(false);

            $table->boolean('visite_medsport_create')->default(false);
            $table->boolean('visite_medsport_read')->default(false);
            $table->boolean('visite_medsport_update')->default(false);
            $table->boolean('visite_medsport_delete')->default(false);

            $table->boolean('visite_medsport_medico')->default(false); //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI MEDSPORT
            $table->boolean('visite_medsport_preanamnesi_read')->default(false);
            $table->boolean('visite_medsport_preanamnesi_update')->default(false);

            //DATI CLINICI MEDSPORT
            $table->boolean('visite_medsport_dati_clinici_read')->default(false);
            $table->boolean('visite_medsport_dati_clinici_update')->default(false);

            //ACCETTAZIONE E VISITE AMBULATORIALI           
            $table->boolean('accettazione_ambulatoriale_view')->default(false);
            $table->boolean('visite_ambulatoriali_create')->default(false);
            $table->boolean('visite_ambulatoriali_read')->default(false);
            $table->boolean('visite_ambulatoriali_update')->default(false);
            $table->boolean('visite_ambulatoriali_delete')->default(false);

            $table->boolean('visite_ambulatoriali_medico')->default(false); //Mostra al medico solo le visite a cui è stato assegnato come medico esecutore

            //PREANAMNESI AMBULATORIALE
            $table->boolean('visite_ambulatoriali_preanamnesi_read')->default(false);
            $table->boolean('visite_ambulatoriali_preanamnesi_update')->default(false);

            //REFERTI AMBULATORIALI
            $table->boolean('visite_ambulatoriali_referto_ambu_read')->default(false);
            $table->boolean('visite_ambulatoriali_referto_ambu_update')->default(false);

            $table->boolean('visite_ambulatoriali_referto_cardio_read')->default(false);
            $table->boolean('visite_ambulatoriali_referto_cardio_update')->default(false);

            $table->boolean('visite_ambulatoriali_referto_fisio_read')->default(false);
            $table->boolean('visite_ambulatoriali_referto_fisio_update')->default(false);

            //CONTABILITA' ( DA VEDERE )
            $table->boolean('gestione_fatture')->default(false);
            $table->boolean('gestione_compensi_medici')->default(false);

            //ESPORTAZIONI
            $table->boolean('dischetto_regione')->default(false);
            $table->boolean('precompilato_730')->default(false);

            //GESTIONE
            $table->boolean('gestione_identificatori')->default(false);
            $table->boolean('gestione_budget_asl')->default(false);
            $table->boolean('gestione_listino_visite_medsport')->default(false);
            $table->boolean('gestione_listino_visite_ambulatoriali')->default(false);
            $table->boolean('gestione_sport')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
};
