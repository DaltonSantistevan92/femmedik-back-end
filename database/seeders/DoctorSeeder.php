<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newDoctor = new Doctor();
        $newDoctor->persona_id = 2;
        $newDoctor->estado = 'A';
        $newDoctor->save();
    }
}
