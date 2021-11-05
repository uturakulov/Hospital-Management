<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Patient;
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
        Doctor::factory(30)->create();
        Patient::factory(30)->create();
    }
}
