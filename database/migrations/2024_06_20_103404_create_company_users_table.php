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
        Schema::create('company_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            //$table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('branch_id')->nullable();
            //$table->foreign('branch_id')->references('id')->on('company_branches');
            $table->string('email', 191)->unique();
            $table->string('name', 191)->unique();
            $table->string('password')->unique();
            $table->string('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_users');
    }
};
