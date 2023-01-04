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
        Schema::create('visite_medsport', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('paziente_id')->nullable();
            $table->foreign('paziente_id')->references('id')->on('pazienti');

            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medici');
            
            $table->unsignedBigInteger('prenotazione_id')->nullable();
            $table->foreign('prenotazione_id')->references('id')->on('prenotazioni');

            $table->unsignedBigInteger('prestazione_id')->nullable();
            $table->foreign('prestazione_id')->references('id')->on('prestazioni_medsport');

            $table->unsignedBigInteger('societa_id')->nullable();
            $table->foreign('societa_id')->references('id')->on('societa_sportive');
            
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->foreign('sport_id')->references('id')->on('tabella_sport');

            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');

            $table->boolean('visita_privata')->default(false);
            $table->integer('pagamento_a_carico')->default(0); //0 : non specificato , 1: atleta , 2: società , 3: gratuita
            $table->string('posizione_ticket')->nullable();

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
        Schema::dropIfExists('visite_medsport');
    }
};