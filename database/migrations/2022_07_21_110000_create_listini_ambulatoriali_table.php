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
        Schema::create('listini_ambulatoriali', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('codice');
            $table->decimal('prezzo');
            $table->integer('durata')->default(10);
            $table->boolean('referto_ambulatoriale')->default(true);
            $table->boolean('referto_cardiologia')->default(false);
            $table->boolean('referto_fisioterapia')->default(false);
            
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
        Schema::dropIfExists('listini_ambulatoriali');
    }
};
