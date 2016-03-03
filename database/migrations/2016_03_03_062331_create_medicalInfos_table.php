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
            $table->increments('medicalInfoId');
            $table->integer('userId')->unsigned();
            $table->integer('length')->unsigned();
            $table->decimal('weight', 5, 2);
            $table->enum('bloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('medicalCondition');
            $table->string('allergies');
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
