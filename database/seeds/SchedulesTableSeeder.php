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
            'interval'      => '1', 
            'time'          => '08:00',
            'amount'        => '1 en half, pilletje in twee breken',
            'updated_at'    => date('Y-m-d h:m:s'),
            ]); 


        DB::table('schedules')->insert([
            'medicine_id'   => 2,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '1',
            'time'          => '12:00',
            'amount'        => '1 en half, pilletje in twee breken',
            'updated_at'    => date('Y-m-d h:m:s'),
            ]); 


        DB::table('schedules')->insert([
            'medicine_id'   => 3,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '1', 
            'time'          => '16:00',
            'amount'        => '1 en half, pilletje in twee breken',
            ]); 


        DB::table('schedules')->insert([
            'medicine_id'   => 1,
            'start_date'    => '2016-03-08 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '1', 
            'time'          => '20:00',
            'amount'        => '1 en half, pilletje in twee breken',
            'updated_at'    => date('Y-m-d h:m:s', time()-(60*60*24) ),
            ]); 













        DB::table('schedules')->insert([
            'medicine_id'   => 5,
            'start_date'    => '2016-04-01 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '2', 
            'time'          => '08:00',
            'amount'        => '1 pil, niet breken en met water innemen.',
            'updated_at'    => date('Y-m-d h:m:s'),
            ]); 
        DB::table('schedules')->insert([
            'medicine_id'   => 6,
            'start_date'    => '2016-04-01 08:00',
            'end_date'      => '2018-03-08 08:00',
            'interval'      => '3', 
            'time'          => '16:00',
            'amount'        => '1 tablet oplossen in water',
            'updated_at'    => date('Y-m-d h:m:s'),
            ]); 
        DB::table('schedules')->insert([
            'medicine_id'   => 7,
            'start_date'    => '2016-04-01 05:10',
            'end_date'      => '2018-03-08 01:03',
            'interval'      => '7', 
            'time'          => '12:00',
            'amount'        => '1 ampule in de ochtend innemen.',
            ]); 
        
        DB::table('schedules')->insert([
            'medicine_id'   => 8,
            'start_date'    => '2016-04-01 05:10',
            'end_date'      => '2018-03-08 01:03',
            'interval'      => '14', 
            'time'          => '12:00',
            'amount'        => "1 ampule oplossen in water of dergelijke. 's Ochtends",
            'updated_at'    => date('Y-m-d h:m:s', time()-(60*60*24) ),
            ]);


        DB::table('schedules')->insert([
            'medicine_id'   => 9,
            'start_date'    => '2016-04-01 05:10',
            'end_date'      => '2018-03-08 01:03',
            'interval'      => '14', 
            'time'          => '13:00',
            'amount'        => "1 ampule oplossen in water of dergelijke. 's Ochtends",
            'updated_at'    => date('Y-m-d h:m:s', time()-(60*60*24) ),
            ]);
    }
}
