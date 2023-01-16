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
        Schema::create('pre_anamnesi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visita_id')->nullable();
            $table->string('visita_type')->nullable();

            $table->boolean('diabete')->nullable();
            $table->string('diabete_chi')->nullable();

            $table->boolean('ipertensione_arteriosa')->nullable();
            $table->string('ipertensione_arteriosa_chi')->nullable();

            $table->boolean('morte_improvvisa_giovanile')->nullable();
            $table->string('morte_improvvisa_giovanile_chi')->nullable();

            $table->boolean('cardiopatia_ischemica_infarto')->nullable();
            $table->string('cardiopatia_ischemica_infarto_chi')->nullable();

            //padre
            //madre
            //nonno paterno
            //nonna paterna
            //nonno materno
            //nonno paterno

            $table->boolean('uso_farmaci')->nullable();
            $table->string('uso_farmaci_quali')->nullable();

            $table->boolean('vaccinazione_antitetanica_obbligatoria')->nullable();
            $table->string('vaccinazione_antitetanica_ultima_data')->nullable();

            $table->boolean('gravidanze')->nullable();
            $table->string('gravidanze_quante')->nullable();

            $table->integer('allenamenti_settimanali')->nullable();
            $table->integer('durata_allenamento')->nullable();

            $table->boolean('disturbi_improvvisi')->nullable();
            $table->boolean('svenimenti')->nullable();
            $table->boolean('dolori_toracici')->nullable();
            $table->boolean('grande_stanchezza')->nullable();

            $table->boolean('idoneita_precedente')->nullable();
            $table->boolean('temporaneamente_non_idoneo')->nullable();
            $table->boolean('accertamenti_precedenti')->nullable();
            $table->text('accertamenti_precedenti_quali')->nullable();

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
        Schema::dropIfExists('pre_anamnesi');
    }
};
