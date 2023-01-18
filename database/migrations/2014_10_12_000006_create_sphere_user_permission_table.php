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
        Schema::create('sphere_user_permission', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sphere_user_id')->nullable();
            $table->unsignedBigInteger('sphere_user_permission_id')->nullable();
            $table->unique(['sphere_user_id' , 'sphere_user_permission_id']);

            $table->foreign('sphere_user_id')->references('id')->on('sphere_users')->onDelete('cascade');
            $table->foreign('sphere_user_permission_id')->references('id')->on('sphere_user_permissions')->onDelete('cascade');
            
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
        Schema::dropIfExists('sphere_user_permission');
    }
};
