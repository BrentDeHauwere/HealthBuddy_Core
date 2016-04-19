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
        // // delete the old pictures
        // $base_directory = './public/userdata/';
        // $folders = scandir($base_directory);
        // foreach($folders as $folder) {
        //     $files = scandir($base_directory.$folder . '/medicines/');
        //     foreach ($files as $file) {
        //         echo $file . "\n"; 
        //     }
        // } 

        // call the  seeds

      $this->call(AddressesTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(MedicalInfosTableSeeder::class);
      $this->call(DevicesTableSeeder::class);
      $this->call(WeightsTableSeeder::class);
      $this->call(MedicinesTableSeeder::class);
      $this->call(SchedulesTableSeeder::class);
      $this->call(IntakesTableSeeder::class);
  }
}
