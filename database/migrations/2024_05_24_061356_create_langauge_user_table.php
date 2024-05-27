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
        Schema::create('langauge_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->enum('read',['b','i','e']);   /** b:beginer , i:intermedatied , e:excellent */
            $table->enum('write',['b','i','e']);  /** b:beginer , i:intermedatied , e:excellent */
            $table->enum('speak',['b','i','e']);  /** b:beginer , i:intermedatied , e:excellent */
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('langauge_user');
    }
};
