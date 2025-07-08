<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpi_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('cycle_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('created_by');
            $table->string('subject');
            $table->string('tgt');
            $table->text('description');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cycle_id')->references('id')->on('kpi_review_cycles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('kpi_categories')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });

        // Pivot tables
        Schema::create('kpi_employee_branch', function (Blueprint $table) {
            $table->unsignedBigInteger('kpi_employee_id');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('kpi_employee_id')->references('id')->on('kpi_employees')->onDelete('cascade');
            $table->foreign('company_branch_id')->references('id')->on('company_branches')->onDelete('cascade');
        });

        Schema::create('kpi_employee_department', function (Blueprint $table) {
            $table->unsignedBigInteger('kpi_employee_id');
            $table->unsignedBigInteger('department_id');
            $table->foreign('kpi_employee_id')->references('id')->on('kpi_employees')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        Schema::create('kpi_employee_designation', function (Blueprint $table) {
            $table->unsignedBigInteger('kpi_employee_id');
            $table->unsignedBigInteger('designation_id');
            $table->foreign('kpi_employee_id')->references('id')->on('kpi_employees')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
        });

        Schema::create('kpi_employee_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('kpi_employee_id');
            $table->unsignedBigInteger('user_id');
            $table->string('achievement')->nullable();
            $table->foreign('kpi_employee_id')->references('id')->on('kpi_employees')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_employee_employee');
        Schema::dropIfExists('kpi_employee_designation');
        Schema::dropIfExists('kpi_employee_department');
        Schema::dropIfExists('kpi_employee_branch');
        Schema::dropIfExists('kpi_employees');
    }
};
