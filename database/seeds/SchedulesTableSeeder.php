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


        // Original schedules with dayOfWeek
        for ($d=0; $d <6; $d++) { 
            DB::table('schedules')->insert([
                'medicine_id' => 1,
                'dayOfWeek' => $d,
                'time' => '09:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]); 
            DB::table('schedules')->insert([
                'medicine_id' => 1,
                'dayOfWeek' => $d,
                'time' => '12:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]);
            DB::table('schedules')->insert([
                'medicine_id' => 1,
                'dayOfWeek' => $d,
                'time' => '18:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]);

            // medicines for eli
            DB::table('schedules')->insert([
                'medicine_id' => 3,
                'dayOfWeek' => $d,
                'time' => '09:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]); 
            DB::table('schedules')->insert([
                'medicine_id' => 3,
                'dayOfWeek' => $d,
                'time' => '12:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]);
            DB::table('schedules')->insert([
                'medicine_id' => 3,
                'dayOfWeek' => $d,
                'time' => '18:00',
                'amount' => rand(1,3),
                'updated_at' => date('Y-m-d'),
                ]);
        }

        DB::table('schedules')->insert([
            'medicine_id' => 1,
            'dayOfWeek' => 2,
            'time' => '09:00',
            'amount' => 1.5,
            'updated_at' => date('Y-m-d'),
            ]);

        DB::table('schedules')->insert([
            'medicine_id' => 1,
            'dayOfWeek' => 4,
            'time' => '09:00',
            'amount' => 1.5,
            'updated_at' => date('Y-m-d'),
            ]);

        DB::table('schedules')->insert([
            'medicine_id' => 2,
            'dayOfWeek' => 7,
            'time' => '14:00',
            'amount' => 2,
            'updated_at' => date('Y-m-d'),
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '11:20',
            'amount' => 2.2,
            'updated_at' => date('Y-m-d'),
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '08:00',
            'amount' => 1,
            'updated_at' => date('Y-m-d'),
            ]);
        DB::table('schedules')->insert([
            'medicine_id' => 3,
            'dayOfWeek' => 7,
            'time' => '16:45',
            'amount' => 1,
            'updated_at' => date('Y-m-d'),
            ]);
    }
}
