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
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->foreign('sphere_user_id')->references('id')->on('sphere_users');
            
            $table->timestamp('data_prenotazione');
            $table->timestamp('data_visita');
            
            //chiavi esterne
            $table->unsignedBigInteger('paziente_id');
            $table->foreign('paziente_id')->references('id')->on('pazienti');
            
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('medici');
            
            $table->unsignedBigInteger('ambulatorio_id');
            $table->foreign('ambulatorio_id')->references('id')->on('ambulatori');

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
        Schema::dropIfExists('prenotazioni');
    }
};
