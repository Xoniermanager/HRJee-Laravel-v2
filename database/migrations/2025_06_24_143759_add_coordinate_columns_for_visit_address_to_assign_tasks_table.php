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
        Schema::table('assign_tasks', function (Blueprint $table) {
            $table->string('visit_address_latitude')->nullable()->after('visit_address');
            $table->string('visit_address_longitude')->nullable()->after('visit_address_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_tasks', function (Blueprint $table) {
            $table->dropColumn(['visit_address_latitude', 'visit_address_longitude']);
        });
    }
};
