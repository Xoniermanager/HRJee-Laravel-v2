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
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('title')->nullable();
            $table->string('instructor')->nullable();
            $table->text('short_description')->nullable();
            $table->enum('content_type', ['pdf', 'youtube', 'vimeo'])->nullable();
            $table->string('video_url')->nullable();
            $table->string('pdf_file')->nullable();
            $table->boolean('has_assignment')->default(0);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricula');
    }
};
