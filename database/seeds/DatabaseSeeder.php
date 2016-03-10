<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddressesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MedicalInfosTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(WeightsTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
