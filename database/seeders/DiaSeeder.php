<?php

namespace Database\Seeders;

use App\Models\Dias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newDia = new Dias();
        $newDia->dia = 'Lunes';
        $newDia->estado = 'A';
        $newDia->orden = 0;
        $newDia->save(); 
        
        $newDia2 = new Dias();
        $newDia2->dia = 'Martes';
        $newDia2->estado = 'A';
        $newDia2->orden = 1;
        $newDia2->save();

        $newDia3 = new Dias();
        $newDia3->dia = 'Miercoles';
        $newDia3->estado = 'A';
        $newDia3->orden = 2;
        $newDia3->save();

        $newDia4 = new Dias();
        $newDia4->dia = 'Jueves';
        $newDia4->estado = 'A';
        $newDia4->orden = 3;
        $newDia4->save();

        $newDia5 = new Dias();
        $newDia5->dia = 'Viernes';
        $newDia5->estado = 'A';
        $newDia5->orden = 4;
        $newDia5->save();

        $newDia7 = new Dias();
        $newDia7->dia = 'Sabado';
        $newDia7->estado = 'A';
        $newDia7->orden = 5;
        $newDia7->save();

        $newDia7 = new Dias();
        $newDia7->dia = 'Domingo';
        $newDia7->estado = 'I';
        $newDia7->orden = 6;
        $newDia7->save();

    }
}
