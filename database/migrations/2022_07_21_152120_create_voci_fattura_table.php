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
        Schema::create('voci_fattura', function (Blueprint $table) {
            $table->id();

            $table->decimal('importo')->nullable();
            $table->string('tipo_pagamento')->nullable();
            $table->decimal('iva')->nullable();
            $table->decimal('bollo')->nullable();

            $table->unsignedBigInteger('fattura_id');
            $table->foreign('fattura_id')->references('id')->on('fatture');
            
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
        Schema::dropIfExists('voci_fattura');
    }
};
