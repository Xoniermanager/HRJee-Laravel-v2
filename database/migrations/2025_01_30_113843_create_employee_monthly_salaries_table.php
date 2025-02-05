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
        Schema::create('employee_monthly_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_salary_id');
            $table->tinyInteger('salary_month');
            $table->tinyInteger('salary_year');
            $table->float('total_salary');
            $table->float('in_hand_salary');
            $table->float('total_deductions');
            $table->float('tax_rate');
            $table->unique(['employee_salary_id','salary_month','salary_year'],'unique_month_salary');
            $table->foreign('employee_salary_id')->references('id')->on('employee_salaries');
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
