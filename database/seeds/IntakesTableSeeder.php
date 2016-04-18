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
            $date = date('2016-03-08 08:'. rand(0,55));
            DB::table('intakes')->insert([
              'schedule_id'   => 1,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*1 . ' days')),
              ]);
        }

        // schedule 2
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08 08:'. rand(0,55) );
            DB::table('intakes')->insert([
              'schedule_id'   => 2,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*2 . ' days')),
              ]);
        }

        // schedule 3
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08 16:'. rand(0,55));
            DB::table('intakes')->insert([
              'schedule_id'   => 3,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*3 . ' days')),
              ]);
        }

        // schedule 4
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08 12:'. rand(0,55));
            DB::table('intakes')->insert([
              'schedule_id'   => 4,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*7 . ' days')),
              ]);
        }


        // schedule 5: Week
        for ($i=0; $i < 20; $i++) { 
            $date = date('2016-03-08 12:'.rand(0,55));
            DB::table('intakes')->insert([
              'schedule_id'   => 5,
              'created_at' => date_add(date_create($date), date_interval_create_from_date_string($i*14 . ' days')),
              ]);
        }

    }
}
