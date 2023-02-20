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
        Schema::create('tabella_numeratori_det', function (Blueprint $table) {
            $table->id();
           
            $table->integer('anno')->nullable();
            $table->integer('valore');

            $table->unsignedBigInteger('numeratore_id')->nullable();
            $table->foreign('numeratore_id')->references('id')->on('tabella_numeratori');

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
        Schema::dropIfExists('tabella_numeratori_det');
    }
};
