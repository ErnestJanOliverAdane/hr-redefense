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
        Schema::create('voluntary_work', function (Blueprint $table) {
            $table->bigInteger('voluntary_work_id')->primary();
            $table->string('name_and_address_of_organization', 150);
            $table->string('number_of_hours', 10);
            $table->string('position_nature_of_work', 50);
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
        Schema::dropIfExists('voluntary_work');
    }
};
