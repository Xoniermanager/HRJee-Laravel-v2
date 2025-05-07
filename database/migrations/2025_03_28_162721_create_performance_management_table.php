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
        Schema::create('performance_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('leave_ranking')->nullable();
            $table->string('attendance_ranking')->nullable();
            $table->string('task_ranking')->nullable();
            // $table->text('manager_review')->nullable();
            // $table->text('hr_review')->nullable();
            $table->boolean('is_approved')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_management');
    }
};
