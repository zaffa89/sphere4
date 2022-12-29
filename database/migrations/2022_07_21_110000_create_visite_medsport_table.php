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

            //$table->unsignedBigInteger('prenotazione_id');
            //$table->foreign('prenotazione_id')->references('id')->on('prenotazioni');

            $table->unsignedBigInteger('prestazione_id');
            $table->foreign('prestazione_id')->references('id')->on('prestazioni_medsport');

            $table->unsignedBigInteger('sport_id')->nullable();
            $table->foreign('sport_id')->references('id')->on('tabella_sport');

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
