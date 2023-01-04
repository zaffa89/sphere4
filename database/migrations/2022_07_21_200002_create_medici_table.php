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
        Schema::create('medici', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->foreign('sphere_user_id')->references('id')->on('sphere_users')->onDelete('set null');

            $table->string('ragione_sociale');
            $table->string('codice_fiscale')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_fisso')->nullable();
            $table->string('email')->nullable();
            $table->string('colore')->nullable();

            $table->string('partita_iva')->nullable();
            $table->string('identificativo_fmsi')->nullable();
            $table->string('codice_tracciato')->nullable();

            $table->text('timbro')->nullable();

            $table->boolean('abilitazione_medsport')->default(false);
            $table->boolean('abilitazione_ambulatoriale')->default(false);
            $table->boolean('abilitazione_cardiologia')->default(false);
            $table->boolean('abilitazione_fisioterapia')->default(false);

            $table->boolean('attivo')->default(true);
            
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
        Schema::dropIfExists('medici');
    }
};
