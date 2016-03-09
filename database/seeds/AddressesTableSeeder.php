<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'street' => 'Kaai',
            'streetNumber' => 170,
            'zipCode' => '1000',
            'city' => 'Anderlecht',
            'country' => 'België'
        ]);

        DB::table('addresses')->insert([
            'street' => 'Nieuwstraat',
            'streetNumber' => 80,
            'zipCode' => '1000',
            'city' => 'Brussel',
            'country' => 'België'
        ]);

        DB::table('addresses')->insert([
            'street' => 'Stenen Stichel',
            'streetNumber' => 9,
            'zipCode' => '9200',
            'city' => 'Dendermonde',
            'country' => 'België'
        ]);

        DB::table('addresses')->insert([
            'street' => 'Brusselsestraat',
            'streetNumber' => 27,
            'zipCode' => '1000',
            'city' => 'Brussel',
            'country' => 'België'
        ]);
    }
}
