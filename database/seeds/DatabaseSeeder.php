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
        $this->call(DeviceRentsTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(MedicalInfosTableSeeder::class);
        $this->call(MedicalSchedulesTableSeeder::class);
        $this->call(MedicalsTableSeeder::class);
        $this->call(WeightsTableSeeder::class);
    }
}
