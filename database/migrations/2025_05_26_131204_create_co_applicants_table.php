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
        Schema::create('co_applicants', function (Blueprint $table) {
           $table->id();
            $table->string('applicant_type');
            $table->string('business_type');
            $table->string('number');
            $table->string('name');
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
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('co_applicants');
    }
};
