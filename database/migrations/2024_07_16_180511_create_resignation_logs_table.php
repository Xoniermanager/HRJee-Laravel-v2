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
        Schema::create('resignation_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_taken_by_id');
            $table->string('action_taken_by_type');
            $table->unsignedBigInteger('resignation_id');
            $table->foreign('resignation_id')->references('id')->on('resignations')->onDelete('cascade');
            $table->text('remark');
            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected',
                'Withdrawn',
                'Hold'
            ])->default('Pending');
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
