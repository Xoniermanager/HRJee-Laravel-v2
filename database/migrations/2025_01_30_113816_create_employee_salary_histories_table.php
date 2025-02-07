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
        Schema::create('employee_salary_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_salary_id');
            $table->unsignedBigInteger('salary_id');
            $table->float('ctc_value');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('changed_by');
            $table->text('change_details');
            $table->foreign('employee_salary_id')->references('id')->on('employee_salaries');
            $table->foreign('salary_id')->references('id')->on('salaries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_histories');
    }
};
