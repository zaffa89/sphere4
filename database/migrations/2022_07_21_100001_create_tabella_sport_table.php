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
        Schema::create('tabella_sport', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tipo_visita');
            $table->string('codice_sport')->nullable();
            
            $table->string('codice_federazione')->nullable();
            $table->string('sigla_federazione')->nullable();
            $table->string('affiliazione')->nullable();

            $table->integer('mesi_scadenza');

            $table->integer('eta_minima_maschi')->nullable();
            $table->integer('eta_massima_maschi')->nullable();
            $table->integer('eta_minima_tem_maschi')->nullable();

            $table->integer('eta_minima_femmine')->nullable();
            $table->integer('eta_massima_femmine')->nullable();
            $table->integer('eta_minima_tem_femmine')->nullable();
            
            $table->integer('anno_di_riferimento');
            $table->string('inizio_anno_riferimento')->nullable();
            $table->string('fine_anno_riferimento')->nullable();
            
            $table->boolean('disabili')->default(false);
            $table->boolean('richiesto_gruppo_sanguigno')->default(false);
            $table->boolean('richiesto_eeg')->default(false);
            $table->boolean('prenotabile_online')->default(false);

            $table->boolean('storico')->nullable();
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
        Schema::dropIfExists('tabella_sport');
    }
};
