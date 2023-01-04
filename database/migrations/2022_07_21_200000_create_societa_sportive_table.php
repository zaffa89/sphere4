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
        Schema::create('societa_sportive', function (Blueprint $table) {
            $table->id();

            $table->string('ragione_sociale');
            $table->string('indirizzo')->nullable();
            $table->string('civico')->nullable();

            $table->unsignedBigInteger('localita_id')->nullable();
            $table->foreign('localita_id')->references('id')->on('tabella_localita');

            $table->string('telefono')->nullable();
            $table->string('email')->nullable();

            $table->string('responsabile')->nullable();
            $table->string('responsabile_telefono')->nullable();
            $table->string('responsabile_email')->nullable();

            $table->string('presidente')->nullable();
            $table->string('presidente_telefono')->nullable();
            $table->string('presidente_email')->nullable();            

            $table->string('partita_iva')->nullable();
            $table->string('codice_fiscale')->nullable();
            
            $table->string('codice_destinatario')->nullable();
            $table->string('pec')->nullable();
            $table->string('codice_nazione')->nullable();

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
        Schema::dropIfExists('societa_sportive');
    }
};
