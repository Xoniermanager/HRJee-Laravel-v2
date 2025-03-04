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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('username');
            $table->string('contact_no');
            $table->string('joining_date');
            $table->string('logo')->nullable();
            $table->string('company_size');
            $table->string('company_url');
            $table->string('company_address');
            $table->unsignedBigInteger('company_type_id');
            $table->foreign('company_type_id')->references('id')->on('company_types');
            $table->string('status')->default(true);
            $table->string('subscription_id')->nullable();
            $table->boolean('allow_face_recognition')->default(0);
            $table->boolean('allow_location_tracking')->default(0);
            $table->integer('face_recognition_user_limit')->default(0);
            $table->integer('location_tracking_user_limit')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
