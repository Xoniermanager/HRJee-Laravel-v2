<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('user_end_status', ['pending', 'processing', 'completed', 'rejected'])->default('pending');
            $table->enum('final_status', ['pending', 'processing', 'completed', 'rejected'])->default('pending');
            $table->text('response_data');
            $table->string('document')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('disposition_code_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('disposition_code_id')->references('id')->on('disposition_codes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_tasks');
    }
};
