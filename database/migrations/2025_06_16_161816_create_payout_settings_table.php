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
        Schema::create('payout_settings', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('lender_id')->nullable();
            $table->enum('payout_type', ['VARIABLE', 'FIXED'])->nullable();
            $table->enum('payout_structure', ['CASE_LEVEL', 'SLAB_BASED'])->nullable();
            $table->integer('minimum_slab')->nullable();
            $table->integer('maximum_slab')->nullable();
            $table->enum('payout_as', ['FIXED', 'DISBURSEMENT'])->nullable();
            $table->string('amount')->nullable();
            $table->enum('sub_payout_type', ['FIXED', 'DISBURSEMENT'])->nullable();
            $table->string('fixed_amount')->nullable();
            $table->date('effective_from')->nullable();
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
        Schema::dropIfExists('payout_settings');
    }
};
