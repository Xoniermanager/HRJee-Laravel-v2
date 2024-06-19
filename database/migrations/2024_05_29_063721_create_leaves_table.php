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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('leave_applied_by')->nullable();
            $table->foreign('leave_applied_by')->references('id')->on('users');
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('leave_type_id');
            $table->foreign('leave_type_id')->references('id')->on('leave_types');
            $table->unsignedBigInteger('leave_status_id');
            $table->foreign('leave_status_id')->references('id')->on('leave_statuses');
            $table->string('reason');
            $table->boolean('is_half_day')->default(false);
            $table->string('from_half_day')->nullable();
            $table->string('to_half_day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
