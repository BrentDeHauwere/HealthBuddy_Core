<?php

use Illuminate\Database\Seeder;

class WeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weights')->insert([
            ['weight' => 67.82, 'user_id' => 2, 'created_at' => '2016-10-08 08:00'],
            ['weight' => 68.22, 'user_id' => 3, 'created_at' => '2016-10-09 08:00'],
            ['weight' => 77.22, 'user_id' => 3, 'created_at' => '2016-10-09 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-08 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-10 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-11 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-12 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-13 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-14 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-15 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-16 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-18 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-19 09:00'],
            ['weight' => 67.89, 'user_id' => 2, 'created_at' => '2016-10-20 09:00'],
            ['weight' => 58.62, 'user_id' => 2, 'created_at' => '2016-10-08 10:00']
        ]);
    }
}
