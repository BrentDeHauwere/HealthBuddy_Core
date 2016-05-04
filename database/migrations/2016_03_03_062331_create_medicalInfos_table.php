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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('length')->unsigned()->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->enum('bloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'onbekend'])->nullable();
            $table->string('medicalCondition')->nullable();
            $table->string('allergies')->nullable();
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
        Schema::drop('medicalInfos');
    }
}
