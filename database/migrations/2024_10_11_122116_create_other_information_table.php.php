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
        Schema::create('other_information', function (Blueprint $table) {
            $table->bigInteger('other_information_id')->primary();
            $table->string('special_skill_hobbies', 50);
            $table->string('nonacademic_distinctions_recognation', 100);
            $table->string('membership_in_assiociation_organization', 100);
            $table->integer('person_id')->nullable();
            $table->foreign('person_id')->references('person_id')->on('personal_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_information');
    }
};
