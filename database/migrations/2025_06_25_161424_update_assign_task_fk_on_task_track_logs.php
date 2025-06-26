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
        Schema::table('task_track_logs', function (Blueprint $table) {
            $table->dropForeign(['assign_task_id']);
        });

        Schema::table('task_track_logs', function (Blueprint $table) {
            $table->foreign('assign_task_id')
                ->references('id')
                ->on('assign_tasks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_track_logs', function (Blueprint $table) {
            $table->dropForeign(['assign_task_id']);
        });

        Schema::table('task_track_logs', function (Blueprint $table) {
            $table->foreign('assign_task_id')
                ->references('id')
                ->on('assign_tasks');
        });
    }
};
