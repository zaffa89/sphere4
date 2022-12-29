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
        Schema::create('tabella_localita', function (Blueprint $table) {
            $table->id();
            $table->integer('vecchio_id');
            $table->string('nome');
            $table->unsignedBigInteger('provincia_id');    
            $table->string('provincia');
            $table->string('sigla_provincia');
            $table->unsignedBigInteger('regione_id');
            $table->string('regione');
            $table->string('nazione');
            $table->string('cap')->nullable();
            $table->string('codice_istat')->nullable();
            $table->string('codice_catastale')->nullable();

            $table->unsignedBigInteger('asl_id')->nullable();
            $table->foreign('asl_id')->references('id')->on('tabella_asl');

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
        Schema::dropIfExists('localita');
    }
};
