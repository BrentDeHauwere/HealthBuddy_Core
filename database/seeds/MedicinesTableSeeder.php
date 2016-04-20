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

        // Medicatie eddi_wallie
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Omeprasol',
            'info'      => "Tegen het zuur, een kuur elke dag een inname 's ochtends voor het eten",
            ]);
        
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Medrol 30Mg',
            'info'      => 'Na de maaltijd, niet op een nuchtere maag. Niet combineren met alcohol',
            'photoUrl'  =>  'userdata/user_2/medicines/Medrol_30Mg.png',
            ]);

        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'immodium',
            'info'      => "indien mottig 1 tabletje innemen",
            ]);
        
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Linazine',
            'info'      => "Voor extra energie in de namiddag",
            ]);
      



        // elke 2 dagen
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Spasmomen',
            'info'      => "Bij hevige krampen.",
            ]);
        

        // elke 3 dagen
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Paracetamol',
            'info'      => 'Enkel nemen bij koorts of opkomende koorts',
            ]);
        // elke week
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Vitamine B',
            'info'      => 'Vitamine kuur om elke week een ampule te nemen smiddags',
            ]);

        // elke 2 weken
        DB::table('medicines')->insert([
            'user_id'   => 2,
            'name'      => 'Vitamine D',
            'info'      => 'Elke 2 weken een ampule sochtends.',
            ]);



        // Medicatie Eli

        DB::table('medicines')->insert([
            'user_id'   => 3,
            'name'      => 'Paracetamol',
            'info'      => 'Enkel nemen bij koorts of opkomende koorts. Niet in te nemen als boost tijdens een vermoeiende dag.',
            ]);
    }
}
