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
        Schema::create('prestazione_servizio_medsport', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('servizio_medsport_id')->nullable();
            $table->unsignedBigInteger('prestazione_medsport_id')->nullable();
            $table->unique(['servizio_medsport_id' , 'prestazione_medsport_id']);

            $table->foreign('servizio_medsport_id')->references('id')->on('servizi_medsport')->onDelete('cascade');
            $table->foreign('prestazione_medsport_id')->references('id')->on('prestazioni_medsport')->onDelete('cascade');

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
        Schema::dropIfExists('prestazione_servizio_medsport');
    }
};