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
        Schema::create('resignation_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_taken_by');
            $table->foreign('action_taken_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('resignation_status_id');
            $table->foreign('resignation_status_id')->references('id')->on('resignation_status')->onDelete('cascade');
            $table->unsignedBigInteger('resignation_id');
            $table->foreign('resignation_id')->references('id')->on('resignations')->onDelete('cascade');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resignation_logs');
    }
};
