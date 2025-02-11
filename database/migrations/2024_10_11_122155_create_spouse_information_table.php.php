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
        Schema::create('spouse_information', function (Blueprint $table) {
            $table->integer('spouse_id')->primary();
            $table->string('surname', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('name_extension', 10)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('employer_name', 100)->nullable();
            $table->string('business_address', 150)->nullable();
            $table->string('telephone_no', 15)->nullable();
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouse_information');
    }
};
