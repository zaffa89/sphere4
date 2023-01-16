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
        Schema::create('dati_clinici_medsport', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('visita_id');
            $table->foreign('visita_id')->references('id')->on('visite_medsport');

            $table->decimal('peso')->nullable();
            $table->decimal('altezza')->nullable();

            //SPIRO
            $table->integer('spiro_capacita_vitale')->nullable();
            $table->integer('spiro_capacita_vitale_forzata')->nullable();
            $table->integer('spiro_volume_espiratorio_massimo_sec')->nullable();
            $table->integer('spiro_indice_tiffenau')->nullable();
            $table->integer('spiro_massima_ventilazione_volontaria')->nullable();
            $table->text('spiro_conclusioni')->nullable();

            //URINE
            $table->string('urine_aspetto')->nullable();
            $table->string('urine_colore')->nullable();
            $table->string('urine_densita')->nullable();
            $table->string('urine_reazione')->nullable();
            $table->text('urine_conclusioni')->nullable();

            //ACUITA' VISIVA
            $table->integer('vista_od_naturale')->nullable();
            $table->integer('vista_os_naturale')->nullable();
            $table->integer('vista_od_corretta')->nullable();
            $table->integer('vista_os_corretta')->nullable();
            $table->text('vista_conclusioni')->nullable();


            //ANAMNESI
            $table->text('anamnesi_familiare')->nullable();
            $table->text('anamnesi_fisiologica')->nullable();
            $table->string('anamnesi_menarca')->nullable();
            $table->date('anamnesi_data_ultima_mestruazione')->nullable();
            $table->string('anamnesi_fumo')->nullable();
            $table->string('anamnesi_alcol')->nullable();
            $table->text('anamnesi_patologica')->nullable();
            $table->text('anamnesi_interventi_chirurgici')->nullable();
            $table->text('anamnesi_infortuni')->nullable();

            //ESAME OBBIETTIVO
            $table->string('eo_trofismo')->nullable();
            $table->text('eo_apparato_locomotore')->nullable();
            $table->text('eo_arti')->nullable();
            $table->text('eo_torace_apparato_respiratorio')->nullable();
            $table->text('eo_apparato_cardiocircolatorio')->nullable();
            $table->text('eo_addome_organi_genitali')->nullable();
            $table->string('eo_senso_cromatico')->nullable();
            $table->string('eo_udito')->nullable();
            $table->text('eo_conclusioni')->nullable();

            //ECG
            $table->integer('ecg_riposo_fc_media')->nullable();
            $table->integer('ecg_riposo_pr')->nullable();
            $table->integer('ecg_riposo_qt')->nullable();
            $table->integer('ecg_riposo_qtc')->nullable();
            $table->text('ecg_riposo_referto')->nullable();

            $table->integer('ecg_dopo_sforzo_fc_media')->nullable();
            $table->integer('ecg_dopo_sforzo_pr')->nullable();
            $table->integer('ecg_dopo_sforzo_qt')->nullable();
            $table->integer('ecg_dopo_sforzo_qtc')->nullable();
            $table->integer('ecg_dopo_sforzo_iri')->nullable();
            $table->integer('ecg_dopo_sforzo_pulsazioni_iri')->nullable();
            $table->string('ecg_dopo_sforzo_valutazione')->nullable();
            $table->text('ecg_dopo_sforzo_referto')->nullable();

            $table->integer('ecg_pressione_riposo_sist')->nullable();
            $table->integer('ecg_pressione_riposo_diast')->nullable();
            $table->integer('ecg_pressione_dopo_sforzo_sist')->nullable();
            $table->integer('ecg_pressione_dopo_sforzo_diast')->nullable();
            $table->integer('ecg_pressione_dopo_sforzo_minuto_sist')->nullable();
            $table->integer('ecg_pressione_dopo_sforzo_diast_sist')->nullable();

            //ESAMI SPECIALISTICI
            $table->text('esame_neurologico')->nullable();
            $table->text('esame_encefalogramma')->nullable();
            $table->text('esame_otorinolaringoiatrico')->nullable();
            $table->text('esame_audiometrico')->nullable();
            $table->text('esame_oculistico')->nullable();

            //ACCERTAMENTI
            $table->text('accertamenti_problematiche_riscontrate')->nullable();
            $table->text('accertamenti_esami_previsti')->nullable();
            $table->text('accertamenti_esami_integrativi')->nullable();
            
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
        Schema::dropIfExists('dati_clinici_medsport');
    }
};
