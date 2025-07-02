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
        Schema::create('connectors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('profession')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->string('connector_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('email')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('bussiness_id')->nullable();
            $table->string('connector_id')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('gst_in')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('short_code')->nullable();
            $table->string('assigned_to')->nullable();
            $table->text('comment')->nullable();
            $table->text('address_proof')->nullable();
            $table->text('uploaded_file')->nullable();
            $table->enum('document_type', ['AADHAR', 'DRIVING', 'PASSPORT'])->nullable();
            $table->enum('status', ['APPROVED', 'REJECTED', 'ASSIGNED', 'UNASSIGNED'])->default('APPROVED');
            $table->enum('connector_level', ['SILVER', 'GOLD', 'PLATINUM'])->default('SILVER');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connectors');
    }
};
