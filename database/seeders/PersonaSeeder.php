<?php

namespace Database\Seeders;

use App\Models\Persona;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $newPersona = new Persona();
        $newPersona->cedula = '0930287768';
        $newPersona->nombre = 'dalton';
        $newPersona->apellido = 'santistevan';
        $newPersona->celular = '0999314187';
        $newPersona->telefono = '0999314187';
        $newPersona->direccion = 'la libertad';
        $newPersona->estado = 'A';
        $newPersona->save();

        //doctora
        $newPersona2 = new Persona();
        $newPersona2->cedula = '2222222222';
        $newPersona2->nombre = 'kerly';
        $newPersona2->apellido = 'santistevan';
        $newPersona2->celular = '0990977904';
        $newPersona2->telefono = '0990977904';
        $newPersona2->direccion = 'la libertad';
        $newPersona2->estado = 'A';
        $newPersona2->save();
    }
}
