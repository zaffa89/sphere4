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
        Schema::create('medici', function (Blueprint $table) {
            $table->id();

            $table->string('nome');

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->foreign('sphere_user_id')->references('id')->on('sphere_users')->onDelete('set null');

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
        Schema::dropIfExists('medici');
    }
};
