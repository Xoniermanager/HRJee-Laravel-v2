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
        Schema::create('leads_status_manage', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->string('lead_id')->nullable();
            $table->string('lead_state')->nullable();
            $table->string('lead_sub_state')->nullable();
            $table->string('lead_next_sub_state')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_status_manage');
    }
};
