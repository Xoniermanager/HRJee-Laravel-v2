<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kpi_review_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->enum('type', ['Monthly', 'Quarterly', 'Yearly', 'Other']);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->unique(['company_id', 'type', 'start_date'], 'unique_cycle_per_company');
            $table->boolean('status')->default(true);
        });
    }

    public function down() {
        Schema::dropIfExists('kpi_review_cycles');
    }
};
