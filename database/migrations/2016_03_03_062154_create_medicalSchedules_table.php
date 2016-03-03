<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalSchedules', function (Blueprint $table) {
            $table->increments('medical_schedule_id');
            $table->integer('medical_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('dayOfWeek')->unsigned();
            $table->time('time');
            $table->decimal('amount', 2, 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicalSchedules');
    }
}
