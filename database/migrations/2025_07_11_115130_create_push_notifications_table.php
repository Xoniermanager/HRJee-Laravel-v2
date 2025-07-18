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
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->text('body');
            $table->json('data')->nullable();
            $table->string('token')->nullable();
            $table->boolean('success')->default(false);
            $table->text('response')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('push_notifications');
    }
};
