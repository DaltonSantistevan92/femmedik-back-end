<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $newUser = new User();
        $newUser->rol_id = 1;
        $newUser->persona_id = 1;
        $newUser->name = 'Dalton92';
        $newUser->imagen = 'user-default.jpg';
        $newUser->email = 'daltonskaterboard@outlook.com';
        $newUser->password = '$2y$10$EMxtP5UXZDuECpIIbmLslOdw1ihcnLHwBxywsjhbQZxWxvrvYFePm';
        $newUser->estado = 'A';
        $newUser->save();

        //doctora
        $newUser2 = new User();
        $newUser2->rol_id = 2;
        $newUser2->persona_id = 2;
        $newUser2->name = 'Kerly';
        $newUser2->imagen = 'kerly.jpg';
        $newUser2->email = 'kerly@gmail.com';
        $newUser2->password = '$2y$10$geLgC6jL7rvZX4UgtjLnv.7RWxC.HAOFkm0fvb6hKJYmRRL5yTapm';
        $newUser2->estado = 'A';
        $newUser2->save();


    }
}
