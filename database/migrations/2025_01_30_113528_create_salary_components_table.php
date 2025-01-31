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
        Schema::create('salary_components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('default_value')->default('0.0');
            $table->boolean('is_taxable')->default(true);
            $table->enum('value_type',['fixed','percentage']);
            $table->unsignedBigInteger('parent_component')->nullable();
            $table->boolean('is_default')->default(false);
            $table->enum('earning_or_deduction',['earning', 'deduction']);
            $table->foreign('parent_component')->references('id')->on('salary_components');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_components');
    }
};
