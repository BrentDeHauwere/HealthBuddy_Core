<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('street');
            $table->integer('streetNumber')->unsigned();
            $table->integer('bus')->unsigned();
            $table->integer('zipCode')->unsigned();
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['Zorgwinkel', 'Zorgmantel', 'Zorgbehoevende']);
            $table->integer('buddy_id')->unsigned()->nullable();
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
        Schema::drop('users');
    }
}
