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
        Schema::create('listino_prestazione_ambulatoriale', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('listino_ambulatoriale_id')->nullable();
            $table->unsignedBigInteger('prestazione_ambulatoriale_id')->nullable();
            $table->unique(['listino_ambulatoriale_id' , 'prestazione_ambulatoriale_id']);

            $table->foreign('listino_ambulatoriale_id')->references('id')->on('listini_ambulatoriali')->onDelete('cascade');
            $table->foreign('prestazione_ambulatoriale_id')->references('id')->on('prestazioni_ambulatoriali')->onDelete('cascade');

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
        Schema::dropIfExists('listino_prestazione_ambulatoriale');
    }
};
