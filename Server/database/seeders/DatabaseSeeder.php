<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(ParentSeeder::class);
        $this->call(MedicalStaffSeeder::class);
        $this->call(VaccinationDetailsSeeder::class);
        $this->call(VaccineSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
