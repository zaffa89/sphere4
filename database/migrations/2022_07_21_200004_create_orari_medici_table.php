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
        Schema::create('orari_medici', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('ambulatorio_id')->nullable();
            $table->foreign('ambulatorio_id')->references('id')->on('ambulatori');

            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medici');

            $table->timestamp('data_inizio');
            $table->timestamp('data_fine');
            
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
        Schema::dropIfExists('orario_medicos');
    }
};
