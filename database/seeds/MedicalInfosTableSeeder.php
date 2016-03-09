<?php

use Illuminate\Database\Seeder;

class MedicalInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicalInfos')->insert([
            'user_id' => 2,
            'length' => 182,
            'weight' => 63.50,
            'bloodType' => 'A+'
        ]);

        DB::table('medicalInfos')->insert([
            'user_id' => 3,
            'length' => 182,
            'weight' => 78.3,
            'bloodType' => 'B-'
        ]);
    }
}
