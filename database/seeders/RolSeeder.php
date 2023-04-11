<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newRol = new Rol();
        $newRol->cargo = "Administrador";
        $newRol->estado = "A";
        $newRol->save();

        $newRol2 = new Rol();
        $newRol2->cargo = "Doctora";
        $newRol2->estado = "A";
        $newRol2->save();

        $newRol3 = new Rol();
        $newRol3->cargo = "Recepcionista";
        $newRol3->estado = "A";
        $newRol3->save();
    }
}
