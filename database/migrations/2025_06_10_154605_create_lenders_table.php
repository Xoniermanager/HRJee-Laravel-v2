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
        Schema::create('lenders', function (Blueprint $table) {
            $table->id();
            $table->string('lender_name')->nullable();
            $table->string('product_id')->nullable();
            $table->string('consent_type')->nullable();
            $table->string('individual_case_routing')->nullable();
            $table->string('bulk_case_routing')->nullable();
            $table->string('hub')->nullable();
            $table->string('pincode')->nullable();
            $table->string('city')->nullable();
            $table->string('lender_link')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenders');
    }
};
