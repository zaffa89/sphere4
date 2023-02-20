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
        Schema::create('listini_medsport', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('codice');
            $table->string('tipo_visita');
            $table->boolean('agonistico')->default(false); //ago o bs
            $table->boolean('tracciato')->default(false);
            $table->boolean('rtp')->default(false);
            $table->string('tipo_scheda')->nullable(); //tipo scheda atleta : azzurra tipo b con ecg a1: bianca con ecg a riposo BS: tipo a1
            $table->decimal('prezzo');
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
        Schema::dropIfExists('listini_medsport');
    }
};
