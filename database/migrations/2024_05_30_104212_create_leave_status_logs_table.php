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
        Schema::create('leave_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_id');
            $table->foreign('leave_id')->references('id')->on('leaves');
            $table->unsignedBigInteger('action_taken_by');
            $table->foreign('action_taken_by')->references('id')->on('users');
            $table->unsignedBigInteger('leave_status_id');
            $table->foreign('leave_status_id')->references('id')->on('leave_statuses');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_status_logs');
    }
};
