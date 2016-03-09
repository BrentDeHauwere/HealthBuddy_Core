<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalInfos', function (Blueprint $table) {
            $table->increments('medical_info_id');
            $table->integer('user_id')->unsigned();
            $table->integer('length')->unsigned();
            $table->decimal('weight', 5, 2);
            $table->enum('bloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('medicalCondition')->nullable();
            $table->string('allergies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicalInfos');
    }
}
