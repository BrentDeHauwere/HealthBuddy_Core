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
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('address_id')->unsigned();
            $table->enum('gender', ['M', 'V']);
            $table->dateTime('dateOfBirth');
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['Zorgwinkel', 'Zorgmantel', 'Zorgbehoevende']);
            $table->integer('buddy_id')->unsigned()->nullable();
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
