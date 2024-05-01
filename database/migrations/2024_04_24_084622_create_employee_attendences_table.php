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
        Schema::create('employee_attendences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('punch_in');
            $table->dateTime('punch_out');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum('punch_in_using',['web','mobile']);
            $table->integer('attendence_type');
            $table->enum('punch_in_by',['self','admin']);
            $table->string('remark');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendences');
    }
};
