<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_monthly_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('month');
            $table->string('year');
            $table->string('monthly_earnings');
            $table->string('monthly_deductions');
            $table->string('monthlyTaxValue')->nullable();
            $table->string('totalLossOfPayAmount')->nullable();
            $table->string('total_working_days');
            $table->string('loss_of_pay_days')->default(0);
            $table->string('salary_calculated_for_days');
            $table->string('monthly_ctc');
            $table->boolean('mail_send')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_monthly_salaries');
    }
};
