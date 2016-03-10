<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            ['user_id' => 2, 'type' => 'iPhone'],
            ['user_id' => 3, 'type' => 'iPhone'],
            ['user_id' => 3, 'type' => 'Apple Watch'],
            ['user_id' => 2, 'type' => 'Weegschaal']
        ]);
    }
}
