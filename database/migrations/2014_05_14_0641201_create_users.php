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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->string('official_email_id', 191)->unique();
            $table->string('password');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('blood_group',['A+','A-','B+','B-','O-','O+']);
            $table->enum('gender',['M','F','O']);                            /**    M:MALE ,F:FEMALE,O:OTHER    */
            $table->enum('marital_status',['M','S']);                       /**    M:MARRIED ,S:SINGLE       */
            $table->unsignedBigInteger('employee_status_id');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('phone')->unique();
            $table->string('profile_image');
            $table->unsignedBigInteger('company_id');
            $table->string('last_login_ip');
            $table->foreign('employee_status_id')->references('id')->on('employee_statuses');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
