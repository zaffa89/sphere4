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
        Schema::create('sphere_user_role_permission', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('sphere_user_role_id')->nullable();
            $table->unsignedBigInteger('sphere_user_permission_id')->nullable();
            $table->unique(['sphere_user_role_id' , 'sphere_user_permission_id']);

            $table->foreign('sphere_user_role_id')->references('id')->on('sphere_user_roles')->onDelete('cascade');
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
        Schema::dropIfExists('sphere_user_role_permission');
    }
};
