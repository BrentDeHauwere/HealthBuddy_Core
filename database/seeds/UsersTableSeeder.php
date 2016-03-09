<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstName' => 'Brent',
            'lastName' => 'De Hauwere',
            'address_id' => 3,
            'gender' => 'M',
            'dateOfBirth' => '1996-06-30',
            'email' => 'brentdehauwere@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'Zorgmantel'
        ]);

        DB::table('users')->insert([
            'firstName' => 'Tobias',
            'lastName' => 'Van Eeckhout',
            'address_id' => 4,
            'gender' => 'M',
            'dateOfBirth' => '1990-08-23',
            'email' => 'eddi_wallie@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'Zorgbehoevende',
            'buddy_id' => 1
        ]);
    }
}
