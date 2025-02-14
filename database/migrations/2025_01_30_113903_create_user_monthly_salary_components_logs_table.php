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
        Schema::create('user_monthly_salary_components_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthly_salary_id');
            $table->unsignedBigInteger('component_id');
            $table->string('name');
            $table->string('monthly');
            $table->enum('type',['earning', 'deduction']);
            $table->foreign('component_id')->references('id')->on('salary_components');
            $table->foreign('monthly_salary_id')->references('id')->on('user_monthly_salaries');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
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
