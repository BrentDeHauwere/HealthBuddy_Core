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
      // NOTE: schedule 1 will have intakes that are "missing" 
      // to emulate the patient forgetting his medicine
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {

        // emulate missing medicine
        if(rand(0,30) != 1){
          DB::table('intakes')->insert([
            'schedule_id'   => 1,
            'created_at' => date_format($start_date, 'Y-m-d') . ' 08:'. rand(0,55),
            ]);
        }
        $start_date = date_add($start_date, date_interval_create_from_date_string('1 day'));
      }


      // schedule 2
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 2,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 12:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('1 days'));
      }


        // schedule 3
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 3,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 16:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('1 days'));
      }

      // schedule 4 
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 4,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 20:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('1 days'));
      }

      // schedule 5: Week
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 5,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 08:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('2 days'));
      }
     // schedule 6
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 6,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 16:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('3 days'));
      }


      // schedule 7
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 7,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 12:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('7 days'));
      }


      // schedule 8
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 8,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 12:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('14 days'));
      }

      // for eli
      // schedule 9
      $start_date = date_create('2016-03-08');
      $end_date = date_create('2018-03-08');
      while($end_date > $start_date) {
        DB::table('intakes')->insert([
          'schedule_id'   => 9,
          'created_at' => date_format($start_date, 'Y-m-d') . ' 13:'. rand(0,55),
          ]);

        $start_date = date_add($start_date, date_interval_create_from_date_string('2 days'));
      }



    }
  }
