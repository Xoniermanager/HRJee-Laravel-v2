<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('official_email_id', 191)->unique();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O-', 'O+', 'N/A'])->default('N/A');
            $table->enum('gender', ['M', 'F', 'O']);
            /**    M:MALE ,F:FEMALE,O:OTHER    */
            $table->enum('marital_status', ['M', 'S', 'N/A'])->default('N/A');
            /**    M:MARRIED ,S:SINGLE       */
            $table->unsignedBigInteger('employee_status_id');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('phone')->unique();
            $table->string(column: 'profile_image')->nullable();
            $table->string('last_login_ip');
            $table->foreign('employee_status_id')->references('id')->on('employee_statuses')->nullable();
            $table->unsignedBigInteger('employee_type_id');
            $table->foreign('employee_type_id')->references('id')->on('employee_types');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->unsignedBigInteger('company_branch_id');
            $table->foreign('company_branch_id')->references('id')->on('company_branches');
            $table->unsignedBigInteger('qualification_id')->nullable();
            $table->foreign('qualification_id')->references('id')->on('qualifications');
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->string('offer_letter_id')->unique()->nullable();
            $table->boolean('work_from_office')->default(false);
            $table->date('exit_date')->nullable();
            $table->string('official_mobile_no')->unique()->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
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
