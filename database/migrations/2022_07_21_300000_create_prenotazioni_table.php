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

            $table->unsignedBigInteger('societa_id')->nullable();
            $table->foreign('societa_id')->references('id')->on('societa_sportive');

            $table->timestamp('data_prenotazione');
            $table->timestamp('data_inizio');
            $table->timestamp('data_fine');

            //chiavi esterne                        
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medici');
            
            $table->unsignedBigInteger('ambulatorio_id');
            $table->foreign('ambulatorio_id')->references('id')->on('ambulatori');

            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');
            
            $table->string('sezione_visita');
            $table->text('note')->nullable();
            $table->boolean('accettata')->default(false);
            
            $table->string('colore')->nullable();

            $table->softDeletes();
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
