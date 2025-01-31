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
        Schema::create('employee_complain_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_complain_id');
            $table->foreign('employee_complain_id')->references('id')->on('employee_complains');
            $table->unsignedBigInteger('from_id');
            // $table->foreign('from_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_id');
            // $table->foreign('to_id')->references('id')->on('users');
            $table->text('message');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_complain_logs');
    }
};
