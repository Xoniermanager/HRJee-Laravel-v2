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
        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['primary', 'secondary']);
            $table->string('contact_no')->unique();
            $table->string('email')->unique();
            $table->string('hr_email')->unique();
            $table->string('address')->unique();
            $table->string('city');
            $table->string('pincode');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('company_id')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->softDeletes('deleted_at')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_branches');
    }
};
