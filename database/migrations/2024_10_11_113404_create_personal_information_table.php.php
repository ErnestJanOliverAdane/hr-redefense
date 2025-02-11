<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->integer('person_id')->primary();
            $table->string('surname', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth', 150)->nullable();
            $table->char('sex', 1)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->char('blood_type', 3)->nullable();
            $table->string('gsis_id', 20)->nullable();
            $table->string('pagibig_id', 20)->nullable();
            $table->string('philhealth_id', 20)->nullable();
            $table->string('sss_id', 20)->nullable();
            $table->string('tin_id', 20)->nullable();
            $table->string('agency_employee_no', 20)->nullable();
            $table->string('citizenship', 30)->nullable();
            $table->string('dual_citizenship', 50)->nullable();
            $table->string('telephone_no', 15)->nullable();
            $table->string('email_address', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_information');
    }
};
