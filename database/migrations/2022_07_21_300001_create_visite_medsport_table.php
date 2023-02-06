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

            $table->boolean('accettata')->default(false);
            $table->timestamp('accettata_at')->nullable();
            
            $table->unsignedBigInteger('paziente_id')->nullable();
            $table->foreign('paziente_id')->references('id')->on('pazienti');

            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medici');
            
            $table->unsignedBigInteger('prenotazione_id')->nullable();
            $table->foreign('prenotazione_id')->references('id')->on('prenotazioni');

            $table->unsignedBigInteger('listino_id')->nullable();
            $table->foreign('listino_id')->references('id')->on('listini_medsport');

            $table->unsignedBigInteger('societa_id')->nullable();
            $table->foreign('societa_id')->references('id')->on('societa_sportive');
            
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->foreign('sport_id')->references('id')->on('tabella_sport');

            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');

            $table->boolean('visita_privata')->default(false);
            $table->integer('pagamento_a_carico')->default(0); //0 : non specificato , 1: atleta , 2: società , 3: gratuita
            $table->string('posizione_ticket')->nullable();

            //IDONEITA'
            $table->timestamp('data_certificato')->nullable();
            $table->integer('numero_certificato')->nullable();
            $table->integer('numero_certificato_rosso')->nullable();
            $table->timestamp('data_scadenza_certificato')->nullable();
            $table->integer('mesi_validita_certificato')->nullable();

            $table->boolean('obbligo_lenti')->nullable();
            $table->string('obbligo_lenti_note')->nullable();
            $table->text('note_idoneita')->nullable();

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
