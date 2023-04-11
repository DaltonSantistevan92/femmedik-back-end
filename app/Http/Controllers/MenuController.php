<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

class MenuController extends Controller
{
    public function mostrarMenu($rol_id, $id_seccion = 0)
    {
        try {
            $menu = Menu::where( 'rol_id', $rol_id )->where( 'id_seccion', $id_seccion )->orderBy('posicion','asc')->get();
            $response = [];

            if( $menu->count() > 0 ){
                $response = [ 'status' => true, 'mensaje' => 'Existen Datos', 'menu' => $menu ];
            }else{
                $response = [ 'status' => false, 'mensaje' => 'No existen Datos', 'menu' => null ];
            }
            return response()->json( $response, 200 );
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }
}
