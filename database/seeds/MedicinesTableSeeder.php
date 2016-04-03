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
            'name'      => 'Medrol 30Mg',
            'info'      => 'Na de maaltijd, niet op een nuchtere maag. Niet combineren met alcohol',
            'photoUrl'  =>  'userdata/user_2/medicines/Medrol_30Mg.png',
            ]);

        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Paracetamol',
            'info'      => 'Enkel nemen bij koorts of opkomende koorts',
            ]);

        DB::table('medicines')->insert([
            'user_id'   => 3,
            'name'      => 'Paracetamol',
            'info'      => 'Enkel nemen bij koorts of opkomende koorts. Niet in te nemen als boost tijdens een vermoeiende dag.',
            ]);
    }
}
