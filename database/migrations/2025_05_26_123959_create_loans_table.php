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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('amount')->nullable();
            $table->string('sanctioned_amount')->nullable();
            $table->date('sanctioned_date')->nullable();
            $table->integer('interest_rate')->nullable();
            $table->string('tenure')->nullable();
            $table->integer('is_identified')->nullable();
            $table->string('approximate_value')->nullable();
            $table->string('ownership')->nullable();
            $table->string('disposition_1')->nullable();
            $table->string('disposition_2')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
