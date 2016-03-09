<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsToMedicalSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicalSchedules', function (Blueprint $table) {
            $table->foreign('medical_id')->references('medical_id')->on('medicals')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicalSchedules', function (Blueprint $table) {
            $table->dropForeign('medicalschedules_medical_id_foreign');
            $table->dropForeign('medicalschedules_user_id_foreign');
        });
    }
}
