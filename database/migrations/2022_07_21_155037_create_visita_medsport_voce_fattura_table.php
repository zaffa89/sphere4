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
        Schema::create('visita_medsport_voce_fattura', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('visita_medsport_id')->nullable();
            $table->unsignedBigInteger('voce_fattura_id')->nullable();
            $table->unique(['visita_medsport_id' , 'voce_fattura_id']);

            $table->foreign('visita_medsport_id')->references('id')->on('visite_medsport')->onDelete('cascade');
            $table->foreign('voce_fattura_id')->references('id')->on('voci_fattura')->onDelete('cascade');

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
        Schema::dropIfExists('visita_medsport_voce_fattura');
    }
};
