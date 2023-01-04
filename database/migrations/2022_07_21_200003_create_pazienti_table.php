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
        Schema::create('pazienti', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');            

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->foreign('sphere_user_id')->references('id')->on('sphere_users');

            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');

            $table->string('codice')->nullable();
            $table->string('nome')->nullable();
            $table->string('cognome')->nullable();
            $table->string('ragione_sociale')->nullable();
            $table->string('sesso' , 1)->nullable();
            $table->date('data_nascita')->nullable();
            
            $table->unsignedBigInteger('localita_nascita_id')->nullable();
            $table->foreign('localita_nascita_id')->references('id')->on('tabella_localita');

            $table->string('codice_fiscale')->nullable();                        

            $table->string('indirizzo')->nullable();
            $table->string('civico')->nullable();
            $table->unsignedBigInteger('localita_residenza_id')->nullable();
            $table->foreign('localita_residenza_id')->references('id')->on('tabella_localita');
            $table->string('cap_residenza')->nullable();

            $table->string('telefono')->nullable();
            $table->string('telefono_fisso')->nullable();
            $table->string('email')->nullable();
            
            $table->text('note')->nullable();

            $table->integer('documento')->nullable();
            $table->string('documento_numero')->nullable();
            $table->date('documento_data_rilascio')->nullable();
            $table->unsignedBigInteger('documento_localita_rilascio_id')->nullable();
            $table->foreign('documento_localita_rilascio_id')->references('id')->on('tabella_localita');

            $table->boolean('disabile')->default(false);
            $table->string('gruppo_sanguigno')->nullable();
            $table->string('fattore_rh')->nullable();
            
            $table->boolean('consenso_privacy')->nullable();
            $table->boolean('consenso_730')->nullable();

            $table->boolean('consenso_sms')->nullable();
            $table->boolean('consenso_email')->nullable();
                       
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
        Schema::dropIfExists('pazienti');
    }
};
