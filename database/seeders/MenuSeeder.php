<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newMenu = new Menu();
        $newMenu->rol_id = 1;
        $newMenu->id_seccion = 0;
        $newMenu->menu = 'dashboard';
        $newMenu->icono = 'home';
        $newMenu->url = 'admin-dash';
        $newMenu->posicion = 0;
        $newMenu->estado = 'A';
        $newMenu->save();

        $newMenu2 = new Menu();
        $newMenu2->rol_id = 1;
        $newMenu2->id_seccion = 0;
        $newMenu2->menu = 'gestión de usuario';
        $newMenu2->icono = 'portrait';
        $newMenu2->url = 'gestion-usuario';
        $newMenu2->posicion = 1;
        $newMenu2->estado = 'A';
        $newMenu2->save();

        $newMenu3 = new Menu();
        $newMenu3->rol_id = 1;
        $newMenu3->id_seccion = 2;
        $newMenu3->menu = 'nuevo usuario';
        $newMenu3->icono = '#';
        $newMenu3->url = 'nuevo-usuario';
        $newMenu3->posicion = 0;
        $newMenu3->estado = 'A';
        $newMenu3->save();

        $newMenu4 = new Menu();
        $newMenu4->rol_id = 1;
        $newMenu4->id_seccion = 2;
        $newMenu4->menu = 'listar usuario';
        $newMenu4->icono = '#';
        $newMenu4->url = 'listar-usuario';
        $newMenu4->posicion = 1;
        $newMenu4->estado = 'A';
        $newMenu4->save();

        $newMenu5 = new Menu();
        $newMenu5->rol_id = 1;
        $newMenu5->id_seccion = 0;
        $newMenu5->menu = 'gestión de horarios';
        $newMenu5->icono = 'date_range';
        $newMenu5->url = 'gestion-horario';
        $newMenu5->posicion = 2;
        $newMenu5->estado = 'A';
        $newMenu5->save();

        $newMenu6 = new Menu();
        $newMenu6->rol_id = 1;
        $newMenu6->id_seccion = 5;
        $newMenu6->menu = 'nuevo horario';
        $newMenu6->icono = '#';
        $newMenu6->url = 'nuevo-horario';
        $newMenu6->posicion = 0;
        $newMenu6->estado = 'A';
        $newMenu6->save();

        $newMenu7 = new Menu();
        $newMenu7->rol_id = 1;
        $newMenu7->id_seccion = 5;
        $newMenu7->menu = 'lista de horarios';
        $newMenu7->icono = '#';
        $newMenu7->url = 'listar-horario';
        $newMenu7->posicion = 1;
        $newMenu7->estado = 'A';
        $newMenu7->save();

    }
}
