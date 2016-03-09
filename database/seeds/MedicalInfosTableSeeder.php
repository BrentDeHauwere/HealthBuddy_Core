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
            'user_id' => 1,
            'length' => 182,
            'weight' => 68.50,
            'bloodType' => 'A+'
        ]);
    }
}
