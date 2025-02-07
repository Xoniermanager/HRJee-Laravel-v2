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
        Schema::create('user_advance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('aadhar_no')->unique();
            $table->string('pan_no')->unique();
            $table->string('uan_no')->unique()->nullable();
            $table->string('esic_no')->unique()->nullable();
            $table->string('pf_no')->unique()->nullable();
            $table->string('insurance_no')->unique()->nullable();
            $table->string('driving_licence_no')->unique()->nullable();
            $table->integer('probation_period')->nullable();
            $table->string('ctc_value')->nullable();
            $table->unsignedBigInteger('salary_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_advance_details');
    }
};
