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
        Schema::create('lease_agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scanned_contract')->nullable();
            $table->unsignedInteger('tenant_id');
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('rent_type_id');
            $table->date('payment_date');
            $table->date('expiration_date');
            $table->decimal('price', 9, 4);
            $table->decimal('deposit', 9, 4);
            $table->integer('duration');
            $table->unsignedBigInteger('user_creates');
            $table->unsignedBigInteger('user_modifies')->nullable();
            $table->foreign('user_creates')->references('id')->on('users');
            $table->foreign('user_modifies')->references('id')->on('users');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('property_id')->references('id')->on('property');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lease_agreements');
    }
};
