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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->unsignedBigInteger('policy_category_id');
            $table->foreign('policy_category_id')->references('id')->on('policy_categories');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->boolean('all_company_branch')->default(false);
            $table->boolean('all_department')->default(false);
            $table->boolean('all_designation')->default(false);
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('company_branch_id')->nullable();
            $table->foreign('company_branch_id')->references('id')->on('company_branches');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
