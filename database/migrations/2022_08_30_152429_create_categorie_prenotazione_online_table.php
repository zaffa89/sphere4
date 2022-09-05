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
        Schema::create('categorie_prenotazione_online', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sezione_prenotazione_online_id')->nullable();
            $table->foreign('sezione_prenotazione_online_id')->references('id')->on('sezioni_prenotazione_online');

            $table->string('nome');
            $table->string('descrizione');
            $table->boolean('attiva');

            $table->boolean('richiedi_sport');
            $table->boolean('limitazioni_sport');
            
            $table->boolean('popup');
            $table->text('popup_contenuto');

            $table->boolean('asd');

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
        Schema::dropIfExists('categorie_prenotazioni_online');
    }
};
