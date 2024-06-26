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
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('punch_in_using', ['Mobile', 'Web']);
            $table->enum('punch_in_by', ['Self', 'Company'])->default('Self');
            $table->enum('work_from', ['Office', 'Home'])->default('Office');
            $table->unsignedBigInteger('attendance_status_id')->nullable();
            $table->foreign('attendance_status_id')->references('id')->on('attendance_statuses');
            $table->boolean('jiofence_auto_check_in')->default(false);
            $table->boolean('jiofence_auto_check_out')->default(false);
            $table->boolean('late')->default(false);
            $table->string('remark')->nullable();
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
