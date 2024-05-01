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
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->enum('branch_type',['primary','secondary']);
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('hr_email')->unique();
            $table->string('address')->unique();
            $table->string('city'); 
            $table->string('pincode');
            $table->string('state');
            $table->string('country_id')->default(1);
            $table->string('status')->nullable();
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
