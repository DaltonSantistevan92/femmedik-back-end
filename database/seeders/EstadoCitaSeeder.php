<?php

namespace Database\Seeders;

use App\Models\EstadoCita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoCitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newEstado = new EstadoCita();
        $newEstado->detalle = 'Pendiente';
        $newEstado->estado = 'A';
        $newEstado->save();

        $newEstado2 = new EstadoCita();
        $newEstado2->detalle = 'Atendido';
        $newEstado2->estado = 'A';
        $newEstado2->save();

        $newEstado3 = new EstadoCita();
        $newEstado3->detalle = 'Eliminadas';
        $newEstado3->estado = 'A';
        $newEstado3->save();

        $newEstado4 = new EstadoCita();
        $newEstado4->detalle = 'En Proceso';
        $newEstado4->estado = 'A';
        $newEstado4->save();


    }
}
