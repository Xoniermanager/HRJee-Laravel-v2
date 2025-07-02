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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_type');
            $table->string('lead_state')->default('Pre Lender');
            $table->string('lead_sub_state')->default('LEAD');
            $table->string('connector_name')->nullable();
            $table->string('applicant_type');
            $table->string('business_type');
            $table->string('customer_number');
            $table->string('customer_name');
            $table->string('assigned_user');
            $table->string('assigned_back_office')->nullable();
            $table->string('know_product');
            $table->string('case_id');
            $table->string('email')->nullable();
            $table->string('pan')->nullable();
            $table->date('incorporation_date')->nullable();
            $table->string('no_of_years')->nullable();
            $table->string('business_profile')->nullable();
            $table->string('pincode')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('reg_pincode')->nullable();
            $table->string('reg_address')->nullable();
            $table->string('reg_city')->nullable();
            $table->string('reg_state')->nullable();
            $table->string('reg_country')->nullable();
            $table->string('disposition_1')->nullable();
            $table->string('disposition_2')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
