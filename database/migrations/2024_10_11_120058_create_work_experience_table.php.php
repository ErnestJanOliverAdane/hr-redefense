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
        Schema::create('work_experience', function (Blueprint $table) {
            $table->bigInteger('work_experience_id')->primary();
            $table->string('position_title', 100);
            $table->string('department_agency_office_company', 100);
            $table->string('monthly_salary', 20);
            $table->string('salaryGrade_step_increment', 20);
            $table->string('status_of_appointment', 50);
            $table->string('govt_service', 10);
            $table->date('inclusive_date');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experience');
    }
};
