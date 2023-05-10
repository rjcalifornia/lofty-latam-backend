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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_number');
            $table->unsignedInteger('lease_id');
            $table->unsignedInteger('payment_type_id');
            $table->date('payment_date');
            $table->integer('month_cancelled');
            $table->decimal('payment', 9, 4);
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('user_creates');
            $table->unsignedBigInteger('user_modifies')->nullable();
            $table->foreign('user_creates')->references('id')->on('users');
            $table->foreign('user_modifies')->references('id')->on('users');
            $table->foreign('lease_id')->references('id')->on('lease_agreements');
            $table->foreign('payment_type_id')->references('id')->on('payment_type_catalog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
