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
        Schema::create('user_ctc_component_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_ctc_history_id');
            $table->foreign('user_ctc_history_id')->references('id')->on('user_ctc_histories');
            $table->unsignedBigInteger('salary_component_id');
            $table->float('value')->default(0.0);
            $table->boolean('is_taxable')->default(true);
            $table->enum('value_type', ['fixed', 'percentage']);
            $table->unsignedBigInteger('parent_component')->nullable();
            $table->enum('earning_or_deduction', ['earning', 'deduction']);
            $table->foreign('salary_component_id')->references('id')->on('salary_components');
            $table->foreign('parent_component')->references('id')->on('salary_components');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ctc_component_histories');
    }
};
