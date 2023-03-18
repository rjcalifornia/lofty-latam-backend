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
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->integer('bedrooms')->nullable();
            $table->integer('beds')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->boolean('has_ac')->nullable();
            $table->boolean('has_kitchen')->nullable();
            $table->boolean('has_dinning_room')->nullable();
            $table->boolean('has_sink')->nullable();
            $table->boolean('has_fridge')->nullable();
            $table->boolean('has_tv')->nullable();
            $table->boolean('has_furniture')->nullable();
            $table->boolean('has_garage')->nullable();
            $table->unsignedBigInteger('landlord_id');
            $table->unsignedInteger('activo');
            $table->unsignedBigInteger('user_creates');
            $table->unsignedBigInteger('user_modifies')->nullable();
            $table->foreign('landlord_id')->references('id')->on('users');
            $table->foreign('user_creates')->references('id')->on('users');
            $table->foreign('user_modifies')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property');
    }
};
