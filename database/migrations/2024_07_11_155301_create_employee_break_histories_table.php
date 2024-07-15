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
        Schema::create('employee_break_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_attendance_id');
            $table->foreign('employee_attendance_id')->references('id')->on('employee_attendances');
            $table->unsignedBigInteger('break_type_id');
            $table->foreign('break_type_id')->references('id')->on('break_types');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_break_histories');
    }
};
