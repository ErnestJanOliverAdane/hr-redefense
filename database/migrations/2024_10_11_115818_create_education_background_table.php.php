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
        Schema::create('educational_background', function (Blueprint $table) {
            $table->integer('education_id')->primary();
            $table->string('level', 30)->nullable();
            $table->string('name_of_school', 150)->nullable();
            $table->string('degree_course', 150)->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('highest_level_units_earned', 50)->nullable();
            $table->year('year_graduated')->nullable();
            $table->string('scholarships_honors', 100)->nullable();
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_background');
    }
};
