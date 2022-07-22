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

            $table->unsignedBigInteger('prenotazione_id');
            $table->foreign('prenotazione_id')->references('id')->on('prenotazioni');
            
            $table->unsignedBigInteger('servizio_ambulatoriale_id');
            $table->foreign('servizio_ambulatoriale_id')->references('id')->on('servizi_ambulatoriali');
            
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
