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
        Schema::create('tenant_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_number');
            $table->string('scanned_document')->nullable();
            $table->unsignedInteger('document_type_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('tenant_id');
            $table->date('issuance_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->unsignedInteger('active');
            $table->unsignedBigInteger('user_creates');
            $table->unsignedBigInteger('user_modifies')->nullable();
            $table->foreign('user_creates')->references('id')->on('users');
            $table->foreign('user_modifies')->references('id')->on('users');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('document_type_id')->references('id')->on('document_type_catalog');
            $table->foreign('country_id')->references('id')->on('countries_catalog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_documents');
    }
};
