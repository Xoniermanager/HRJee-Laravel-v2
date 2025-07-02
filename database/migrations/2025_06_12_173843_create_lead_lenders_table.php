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
        Schema::create('lead_lenders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('lender_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('purpose')->nullable();
            $table->boolean('getting_eligibility_passed')->nullable();
            $table->string('score')->nullable();
            $table->string('max_loan_amount')->nullable();
            $table->string('total_emi')->nullable();
            $table->string('tenure')->nullable();
            $table->string('roi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_lenders');
    }
};
