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
        Schema::create('employee_leave_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_leave_available_id');
            $table->foreign('employee_leave_available_id')->references('id')->on('employee_leave_availables');
            $table->integer('credit')->default(0);
            $table->integer('debit')->default(0);
            $table->integer('available');
            $table->string('mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_management');
    }
};
