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
        DB::table('schedules')->insert([
            'medicine_id' => 1,
            'dayOfWeek' => 2,
            'time' => '09:00',
            'amount' => 1.5
            ]);

        DB::table('schedules')->insert([
            'medicine_id' => 1,
            'dayOfWeek' => 4,
            'time' => '09:00',
            'amount' => 1.5
            ]);

        DB::table('schedules')->insert([
            'medicine_id' => 2,
            'dayOfWeek' => 7,
            'time' => '14:00',
            'amount' => 2
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '11:20',
            'amount' => 2.2
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '08:00',
            'amount' => 1
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '16:45',
            'amount' => 1
            ]);
    }
}
