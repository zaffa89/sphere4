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
        Schema::create('referti_cardiologia', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('visita_id');
            $table->foreign('visita_id')->references('id')->on('visite_ambulatoriali');

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
        Schema::dropIfExists('referti_cardiologia');
    }
};
