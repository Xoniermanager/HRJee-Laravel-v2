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
        Schema::create('week_day_weekend', function (Blueprint $table) {
            $table->unsignedBigInteger('week_day_id');
            $table->foreign('week_day_id')->references('id')->on('week_days');
            $table->unsignedBigInteger('weekend_id');
            $table->foreign('weekend_id')->references('id')->on('weekends');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('week_day_weekend');
    }
};
