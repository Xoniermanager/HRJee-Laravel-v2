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
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('punch_in');
            $table->dateTime('punch_out')->nullable();
            $table->string('punch_in_latitude')->nullable();
            $table->string('punch_in_longitude')->nullable();
            $table->string('punch_in_address')->nullable();
            $table->string('punch_out_latitude')->nullable();
            $table->string('punch_out_longitude')->nullable();
            $table->string('punch_out_address')->nullable();
            $table->enum('punch_in_using', ['Mobile', 'Web', 'Face']);
            $table->enum('punch_in_by', ['Self', 'Company'])->default('Self');
            $table->enum('work_from', ['Office', 'Home'])->default('Office');
            $table->unsignedBigInteger('attendance_status_id')->nullable();
            $table->foreign('attendance_status_id')->references('id')->on('attendance_statuses');
            $table->boolean('jiofence_auto_check_in')->default(false);
            $table->boolean('jiofence_auto_check_out')->default(false);
            $table->string('total_break_time')->nullable();
            $table->boolean('late')->default(false);
            $table->boolean('is_short_attendance')->default(false);
            $table->enum('status', [1,2])->default('1')->comment('Status: NORMAL=1, HALF=2');
            $table->string('remark')->nullable();
            $table->boolean('is_auto_punch_out')->default(false);
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
        Schema::dropIfExists('employee_attendances');
    }
};
