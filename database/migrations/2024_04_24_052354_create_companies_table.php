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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('contact_no')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('status');
            $table->unsignedBigInteger('role_id');
            $table->date('joinging_date');
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->string('company_logo');
            $table->timestamps();

            // $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('status')->references('id')->on('company_statuses');
            $table->foreign('role_id')->references('id')->on('roles');
            
            
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

