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
        Schema::create('pre_anamnesi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visita_id')->nullable();
            $table->string('visita_type')->nullable();

            $table->boolean('diabete')->nullable();
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
        Schema::dropIfExists('pre_anamnesi');
    }
};
