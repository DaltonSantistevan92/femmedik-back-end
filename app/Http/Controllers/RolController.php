<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function contarRol(){
        try {
            $contarRol = Rol::where('estado','A')->get();
            $response = [];

            if( $contarRol->count() > 0 ){
                foreach($contarRol as $ca){
                    $ca->cargo;
                }
                $response = [
                    'status' => true,
                    'cantidad' => $contarRol->count(),
                    'rol' => 'Roles'
                ];
            }else{
                $response = [
                    'status' => false,
                    'cantidad' => 0,
                    'rol' => null
                ];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
        
    }
}
