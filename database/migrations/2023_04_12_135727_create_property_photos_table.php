<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->string('image_name')->nullable();
            $table->unsignedInteger('active');
            $table->unsignedInteger('order')->nullable();
            $table->unsignedBigInteger('user_creates');
            $table->unsignedBigInteger('user_modifies')->nullable();
            $table->foreign('user_creates')->references('id')->on('users');
            $table->foreign('user_modifies')->references('id')->on('users');
            $table->foreign('property_id')->references('id')->on('property');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_photos');
    }
};
