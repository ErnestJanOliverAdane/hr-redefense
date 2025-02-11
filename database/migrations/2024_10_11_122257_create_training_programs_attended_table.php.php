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
        Schema::create('training_programs_attended', function (Blueprint $table) {
            $table->bigInteger('training_programs_id')->primary();
            $table->string('training_programs', 100);
            $table->string('number_of_hours', 10);
            $table->string('conducted_sponsored_by', 100);
            $table->string('inclusive_date_of_attendance', 20);
            $table->date('from');
            $table->date('to');
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_programs_attented');
    }
};
