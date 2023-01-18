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
        Schema::create('sphere_users', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('username')->unique();           

            $table->unsignedBigInteger('sphere_user_role_id')->nullable();
            $table->foreign('sphere_user_role_id')->references('id')->on('sphere_user_roles')->onDelete('set null');

            $table->boolean('attivo')->default(true);
            
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
        Schema::dropIfExists('sphere_users');
    }
};
