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
        Schema::create('employee_monthly_salary_components_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthly_salary_id');
            $table->unsignedBigInteger('salary_component_id');
            $table->string('salary_component_name');
            $table->float('value');
            $table->boolean('is_taxable');
            $table->enum('earning_or_deduction',['earning', 'deduction']);
            $table->foreign('salary_component_id')->references('id')->on('salary_components')->index('fk_monthly_salary_component_id');
            $table->foreign('monthly_salary_id')->references('id')->on('employee_monthly_salaries')->index('fk_monthly_salary_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_monthly_salary_components_logs');
    }
};
