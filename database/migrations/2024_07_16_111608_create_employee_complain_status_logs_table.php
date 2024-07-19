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
        Schema::create('employee_complain_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_complain_id');
            $table->foreign('employee_complain_id')->references('id')->on('employee_complains');
            $table->unsignedBigInteger('hr_login_id');
            $table->foreign('hr_login_id')->references('id')->on('users');
            $table->unsignedBigInteger('current_status_id');
            $table->foreign('current_status_id')->references('id')->on('complain_statuses');
            $table->unsignedBigInteger('new_status_id');
            $table->foreign('new_status_id')->references('id')->on('complain_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_complain_status_logs');
    }
};
