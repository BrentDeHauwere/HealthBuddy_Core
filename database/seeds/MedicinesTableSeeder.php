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
            'user_id'   => 2,
            'name'      => 'Medrol',
            'info'      => 'Na de maaltijd, niet op een nuchtere maag. Niet combineren met alcohol',
        ]);

        DB::table('medicines')->insert([
            'user_id'   => 3,
            'name'      => 'Paracetamol',
            'info'      => 'Enkel nemen bij koorts of opkomende koorts',
        ]);
    }
}
