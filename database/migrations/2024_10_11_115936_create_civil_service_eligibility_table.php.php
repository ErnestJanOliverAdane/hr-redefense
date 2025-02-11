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
        Schema::create('civil_service_eligibility', function (Blueprint $table) {
            $table->bigInteger('civil_service_eligibility_id')->primary();
            $table->string('career_service', 50);
            $table->integer('rating');
            $table->date('date_of_examination');
            $table->string('place_of_examination_conferment', 100);
            $table->string('license', 15);
            $table->integer('number');
            $table->date('date_of_validity');
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civil_service_eligibility');
    }
};
