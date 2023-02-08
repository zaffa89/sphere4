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
        Schema::create('prestazioni_medsport', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('codice');
            $table->decimal('prezzo')->default(0);
            $table->integer('durata')->default(10);
            
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
        Schema::dropIfExists('prestazioni_medsport');
    }
};
