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
        Schema::create('assign_holiday_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("holiday_id");
            $table->unsignedBigInteger("company_branch_id");
            $table->foreign('holiday_id')->references('id')->on('holidays');
            $table->foreign('company_branch_id')->references('id')->on('company_branches');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_holiday_branches');
    }
};
