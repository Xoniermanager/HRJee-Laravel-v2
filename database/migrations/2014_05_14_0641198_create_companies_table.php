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
            $table->string('joining_date');
            $table->string('logo');
            $table->string('company_size');
            $table->string('company_url');
            $table->string('company_address');
            $table->unsignedBigInteger('company_type_id');
            $table->string('subscription_id')->nullable();
            $table->string('status')->default(true);
            $table->foreign('company_type_id')->references('id')->on('company_types');
            $table->timestamps();
            $table->softDeletes();
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
