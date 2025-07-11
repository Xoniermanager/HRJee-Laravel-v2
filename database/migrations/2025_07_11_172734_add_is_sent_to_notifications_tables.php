<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->tinyInteger('is_sent')->default(0)->after('status');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->tinyInteger('is_sent')->default(0)->after('status');
        });

        Schema::table('policies', function (Blueprint $table) {
            $table->tinyInteger('is_sent')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('is_sent');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('is_sent');
        });

        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn('is_sent');
        });
    }
};
