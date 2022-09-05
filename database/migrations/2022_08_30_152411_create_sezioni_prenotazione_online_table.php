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
        Schema::create('sezioni_prenotazione_online', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->text('descrizione');
            $table->boolean('attiva');
            $table->integer('ordine');

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
        Schema::dropIfExists('sezioni_prenotazione_online');
    }
};
