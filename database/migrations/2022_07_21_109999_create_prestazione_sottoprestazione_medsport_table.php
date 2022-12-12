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
        Schema::create('prestazione_sottoprestazione_medsport', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('prestazione_medsport_id')->nullable();
            $table->unsignedBigInteger('sottoprestazione_medsport_id')->nullable();
            $table->unique(['prestazione_medsport_id' , 'sottoprestazione_medsport_id']);

            $table->foreign('prestazione_medsport_id')->references('id')->on('prestazioni_medsport')->onDelete('cascade');
            $table->foreign('sottoprestazione_medsport_id')->references('id')->on('sottoprestazioni_medsport')->onDelete('cascade');

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
        Schema::dropIfExists('prestazione_sottoprestazione_medsport');
    }
};