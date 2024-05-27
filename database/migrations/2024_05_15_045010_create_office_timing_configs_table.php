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
        Schema::create('office_timing_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_branch');
            $table->string('shift_hours');
            $table->string('half_day_hours');
            $table->string('min_shift_Hours');
            $table->string('min_half_day_hours');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_timing_configs');
    }
};
