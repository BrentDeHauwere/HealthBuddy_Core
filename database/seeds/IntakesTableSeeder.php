<?php

use Illuminate\Database\Seeder;

class IntakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Update this after updathin the Schedule model

        // schedule 1
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08');
            DB::table('intakes')->insert([
              'schedule_id'   => 1,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*2 . ' days')),
              ]);
        }

        // schedule 2
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08');
            DB::table('intakes')->insert([
              'schedule_id'   => 2,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*3 . ' days')),
              ]);
        }


        // // intakes for user eddi 
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 3,
    	// 	'created_at' => '2016-04-01 18:00',
    	// 	]);
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 1,
    	// 	'created_at' => '2016-04-03 07:10',
    	// 	]);
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 3,
    	// 	'created_at' => '2016-04-03 17:31',
    	// 	]);
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 1,
    	// 	'created_at' => '2016-04-05 08:00',
    	// 	]);
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 3,
    	// 	'created_at' => '2016-04-05 18:00',
    	// 	]);
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 1,
    	// 	'created_at' => '2016-04-08 07:51',
    	// 	]);  
    	// DB::table('intakes')->insert([
    	// 	'schedule_id'   => 3,
    	// 	'created_at' => '2016-04-08 18:23',
    	// 	]);
    }
}
