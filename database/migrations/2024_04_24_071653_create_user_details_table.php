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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->string('gurdian_name')->nullable();
            $table->string('gurdian_contact')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('country_id')->nullable();
            $table->string('resume')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('joining_letter')->nullable();
            $table->string('contract_document')->nullable();
            $table->date('exit_date')->nullable();
            $table->string('Salary')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};