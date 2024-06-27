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
            $table->string('username');
            $table->string('contact_no');
            $table->string('email');
            $table->string('role_id')->nullable();
            $table->string('joining_date');
            $table->string('logo');
            $table->string('company_size');
            $table->string('company_url');
            $table->string('industry_type');
            $table->string('company_address');
            $table->string('subscription_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            // $table->foreign('subscription_id')->references('id')->on('subscriptions');
            // $table->foreign('status')->references('id')->on('company_statuses');
            // $table->foreign('role_id')->references('id')->on('roles');
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

