<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unsigned();

            // Basic info
            $table->time('time');
            $table->string('amount');
            
            // take this medicint at exactely this time.
            $table->integer('dayOfWeek')->unsigned()->nullable();

            // Take this medicine each X days.
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('interval')->nullable();

            $table->timestamps(); // eloquent needs this: created_at && updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
