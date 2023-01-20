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
        Schema::create('user_role_permission', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_role_id')->nullable();
            $table->unsignedBigInteger('user_permission_id')->nullable();
            $table->unique(['user_role_id' , 'user_permission_id']);

            $table->foreign('user_role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->foreign('user_permission_id')->references('id')->on('user_permissions')->onDelete('cascade');
            
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
        Schema::dropIfExists('user_role_permission');
    }
};
