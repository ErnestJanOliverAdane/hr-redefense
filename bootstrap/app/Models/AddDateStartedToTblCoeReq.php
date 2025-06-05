<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class AddDateStartedToTblCoeReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_coe_req', function (Blueprint $table) {
            // Add DateStarted field if it doesn't exist
            if (!Schema::hasColumn('tbl_coe_req', 'DateStarted')) {
                $table->date('DateStarted')->nullable()->after('or_number');
            }
        });

        // Populate the DateStarted field with data from masterlist.created_at
        DB::statement("
            UPDATE tbl_coe_req
            JOIN masterlist ON tbl_coe_req.employee_id = masterlist.employee_id
            SET tbl_coe_req.DateStarted = DATE(masterlist.created_at)
            WHERE tbl_coe_req.DateStarted IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_coe_req', function (Blueprint $table) {
            $table->dropColumn('DateStarted');
        });
    }
}