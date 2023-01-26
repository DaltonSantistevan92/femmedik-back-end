<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function contarUsuario()
    {
        try {
            $admin = 1;
            $contarUsuario = User::where('estado','A')->where('rol_id',$admin)->get();
            $response = [];

            if ($contarUsuario->count() > 0) {
                $response = [
                    'status' => true,
                    'cantidad' => $contarUsuario->count(),
                    'usuario' => 'Usuario',
                ];
            } else {
                $response = [
                    'status' => false,
                    'cantidad' => 0,
                    'usuario' => null,
                ];
            }
        return response()->json($response);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
        
    }
}
