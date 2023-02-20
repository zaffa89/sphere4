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
        Schema::create('tabella_numeratori', function (Blueprint $table) {
            $table->id();            

            $table->string('codice');
            $table->string('descrizione');
            $table->string('tipo');
            $table->boolean('automatico')->default(true);
            $table->string('suffisso')->nullable();

            $table->unsignedBigInteger('struttura_id')->nullable();
            $table->foreign('struttura_id')->references('id')->on('strutture');

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
        Schema::dropIfExists('tabella_numeratori');
    }
};
