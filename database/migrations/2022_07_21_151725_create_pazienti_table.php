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
        Schema::create('pazienti', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');            

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->foreign('sphere_user_id')->references('id')->on('sphere_users');

            $table->unsignedBigInteger('struttura_id');
            $table->foreign('struttura_id')->references('id')->on('strutture');

            $table->string('nome');
            $table->string('cognome');
            $table->string('sesso' , 1);
            $table->timestamp('data_nascita');
            
            $table->string('codice_fiscale');
            
            $table->string('indirizzo');
            $table->string('civico');

            $table->string('telefono');
            $table->string('email');
            
            $table->text('note');
            
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
        Schema::dropIfExists('pazienti');
    }
};
