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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->time('start_time');
            $table->time('end_time');
            $table->time('half_day_login');
            $table->string('check_in_buffer');
            $table->string('total_late_count');
            $table->string('total_leave_deduction');
            $table->string('check_out_buffer');
            $table->string('min_late_count');
            $table->string('login_before_shift_time');
            $table->integer('early_checkout_count');
            $table->boolean('status')->default(0);
            $table->boolean('is_default')->default(0);
            $table->unsignedBigInteger('office_timing_config_id');
            $table->boolean('apply_late_count')->default(0);
            $table->boolean('apply_early_checkout_count')->default(0);
            $table->boolean('lock_attendance')->default(0);
            $table->foreign('office_timing_config_id')->references('id')->on('office_timing_configs');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
