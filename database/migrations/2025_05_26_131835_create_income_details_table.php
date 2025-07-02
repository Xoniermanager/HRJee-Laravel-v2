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
        Schema::create('income_details', function (Blueprint $table) {
            $table->id();
            $table->string('latest_turnover')->nullable();
            $table->string('previous_turnover')->nullable();
            $table->string('latest_profit')->nullable();
            $table->string('previous_profit')->nullable();
            $table->string('total_loan_outstanding')->nullable();
            $table->string('total_current_monthly_emi')->nullable();
            $table->string('comment')->nullable();
            $table->integer('is_coapplicant')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_details');
    }
};
