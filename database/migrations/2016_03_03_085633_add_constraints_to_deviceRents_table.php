<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsToDeviceRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deviceRents', function (Blueprint $table) {
            $table->primary(['userId', 'deviceId']);
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->foreign('deviceId')->references('deviceId')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviceRents', function (Blueprint $table) {
            //
        });
    }
}
