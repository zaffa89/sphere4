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
        Schema::create('visite_ambulatoriali', function (Blueprint $table) {
            $table->id();

            $table->boolean('accettata')->default(false);
            $table->timestamp('accettata_at')->nullable();
            
            $table->timestamp('data_visita');

            $table->unsignedBigInteger('paziente_id')->nullable();
            $table->foreign('paziente_id')->references('id')->on('pazienti');

            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medici');
            
            $table->unsignedBigInteger('prenotazione_id')->nullable();
            $table->foreign('prenotazione_id')->references('id')->on('prenotazioni');
            
            $table->unsignedBigInteger('societa_id')->nullable();
            $table->foreign('societa_id')->references('id')->on('societa_sportive');
            
            $table->unsignedBigInteger('listino_id');
            $table->foreign('listino_id')->references('id')->on('listini_ambulatoriali');
            
            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');

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
        Schema::dropIfExists('visite_ambulatoriali');
    }
};
