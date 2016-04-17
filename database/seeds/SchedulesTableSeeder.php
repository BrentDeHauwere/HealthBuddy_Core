<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // new schedules
        DB::table('schedules')->insert([
            'medicine_id'   => 1,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '2', 
            'time'          => '09:00',
            'amount'        => rand(1,3),
            ]); 
        DB::table('schedules')->insert([
            'medicine_id'   => 2,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '3', 
            'time'          => '12:00',
            'amount'        => rand(1,3),
            ]); 
        DB::table('schedules')->insert([
            'medicine_id'   => 2,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '7', 
            'time'          => '23:11',
            'amount'        => rand(1,3),
            ]); 
        DB::table('schedules')->insert([
            'medicine_id'   => 2,
            'start_date'    => '2016-03-12 05:10',
            'end_date'      => '2018-03-08 01:03',
            'interval'      => '1', 
            'time'          => '12:11',
            'amount'        => rand(1,3),
            ]); 
        
    }
}
