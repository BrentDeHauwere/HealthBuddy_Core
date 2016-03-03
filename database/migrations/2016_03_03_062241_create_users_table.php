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
            $table->increments('userId');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('addressId')->unsigned();
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['Zorgwinkel', 'Zorgmantel', 'Zorgbehoevende']);
            $table->integer('buddyId')->unsigned();
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
