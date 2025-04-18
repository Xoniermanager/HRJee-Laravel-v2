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
        Schema::create('company_menu', function (Blueprint $table) {
            $table->unsignedBigInteger("menu_id");
            $table->unsignedBigInteger("company_id");
            $table->foreign('menu_id')->references('id')->on('menus');
            //$table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_menu_permissions');
    }
};
