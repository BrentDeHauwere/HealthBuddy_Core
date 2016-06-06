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
            'firstName' => 'Frans',
            'lastName' => 'De Hauwere',
            'address_id' => 3,
            'gender' => 'M',
            'dateOfBirth' => '1976-06-30',
            'email' => 'frans@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'role' => 'Zorgmantel'
        ]);

        DB::table('users')->insert([
            'firstName' => 'Eddi',
            'lastName' => 'DeLanghe',
            'address_id' => 4,
            'gender' => 'M',
            'dateOfBirth' => '1950-08-23',
            'email' => 'eddi@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'role' => 'Zorgbehoevende',
            'buddy_id' => 1
        ]);

        DB::table('users')->insert([
            'firstName' => 'Eli',
            'lastName' => 'Jansens',
            'address_id' => 2,
            'gender' => 'M',
            'dateOfBirth' => '1947-09-20',
            'email' => 'eli@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'role' => 'Zorgbehoevende',
            'buddy_id' => 1
        ]);


        DB::table('users')->insert([
            'firstName' => 'Marie',
            'lastName' => 'De Bee',
            'address_id' => 1,
            'gender' => 'M',
            'dateOfBirth' => '1962-09-20',
            'email' => 'marie@healthbuddy.be',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'role' => 'Zorgwinkel',
            // 'buddy_id' => 1
        ]);
    }
}
