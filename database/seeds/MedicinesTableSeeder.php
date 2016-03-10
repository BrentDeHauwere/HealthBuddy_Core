<?php

use Illuminate\Database\Seeder;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            'user_id' => 2,
            'name' => 'Paracetamol'
        ]);

        DB::table('medicines')->insert([
            'user_id' => 3,
            'name' => 'Paracetamol'
        ]);
    }
}
