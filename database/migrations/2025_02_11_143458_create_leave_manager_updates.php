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
        Schema::create('leave_manager_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('leave_id');
            $table->unsignedBigInteger('leave_status_id')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_manager_updates');
    }
};
