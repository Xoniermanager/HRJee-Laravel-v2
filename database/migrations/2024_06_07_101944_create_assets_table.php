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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('asset_category_id');
            $table->foreign('asset_category_id')->references('id')->on('asset_categories');
            $table->unsignedBigInteger('asset_manufacturer_id');
            $table->foreign('asset_manufacturer_id')->references('id')->on('asset_manufacturers');
            $table->unsignedBigInteger('asset_status_id');
            $table->foreign('asset_status_id')->references('id')->on('asset_statuses');
            $table->string('model');
            $table->enum('ownership', ['owned', 'rented'])->default('owned');
            $table->float('purchase_value');
            $table->float('depreciation_per_year')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date');
            $table->date('validation_upto');
            $table->string('serial_no');
            $table->string('invoice_file')->nullable();
            $table->enum('allocation_status', ['available', 'allocated'])->default('available');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
