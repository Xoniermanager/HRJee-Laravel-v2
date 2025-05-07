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
        Schema::create('category_performance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performance_management_id')->nullable();
            $table->unsignedBigInteger('performance_category_id')->nullable();
            $table->enum('performance', ['UNSATISFACTORY', 'SATISFACTORY', 'GOOD', 'EXCELLENT'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_performance_records');
    }
};
