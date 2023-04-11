<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Validator,Hash};


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

    public function listar(){
        $usuario = User::where('estado','A')->orderBy('name','ASC')->get();
        $response = [];

        if($usuario->count() > 0){
            foreach($usuario as $u){
                $u->persona;  $u->rol;
            }
            $response = ['status' => true, 'cantidad' => $usuario->count(), 'usuario' => $usuario ];
        }else{
            $response = ['status' => false, 'cantidad' => 0, 'usuario' => null ];
        }
        return response()->json($response);
    }

    public function listaxId($id){
        $usuario = User::find($id);

        if($usuario){
            $usuario->persona;
            $usuario->rol;

            $response = [ 'status' => true, 'mensaje' => 'existen datos', 'usuario' => $usuario ];
        }else{
            $response = [ 'status' => false, 'mensaje' => 'no existen datos', 'usuario' => null ];
        }
        return response()->json($response);
    }

    public function editarUsuario(Request $request){
        try {
            $usuarioRequest = (object) $request->usuario;
            $response = [];
            $dataUsuario = User::find($usuarioRequest->id);

            if($usuarioRequest){
                if($dataUsuario){
                    $dataUsuario->rol_id = $usuarioRequest->rol_id;
                    $dataUsuario->persona_id = $usuarioRequest->persona_id;
                    $dataUsuario->name = $usuarioRequest->name;
                    $dataUsuario->email = $usuarioRequest->email;

                    $dataPersona = Persona::find($dataUsuario->persona_id);
                    $dataPersona->nombre = $usuarioRequest->nombre;
                    $dataPersona->apellido = $usuarioRequest->apellido;
                    $dataPersona->telefono = $usuarioRequest->telefono;
                    $dataPersona->direccion = $usuarioRequest->direccion;

                    $dataPersona->save();
                    $dataUsuario->save();

                    $response = [ 'status' => true, 'mensaje' => 'El usuario se actualizo correctamente', 'usuario' => $dataUsuario ];
                }else {
                    $response = [ 'status' => false, 'mensaje' => 'No se puede actualizar el usuario', 'usuario' => null ];
                }
            }else {
                $response = [ 'status' => false, 'mensaje' => 'No hay datos para procesar', 'usuario' => null ];
            }
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'mensaje' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }


    public function eliminarUsuario(Request $request){
        try{
            $usuarioRequest = (object)$request->data;
            $response = [];

            $dataUsuario = User::find($usuarioRequest->id);

            if($dataUsuario){
                $dataUsuario->estado = 'I';
                $dataUsuario->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'Se ha eliminado el usuario',
                ];
            }else{
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede eliminar el usuario',
                ];
            }
            return response()->json($response, 200);
        }catch (\Throwable $th) {
            $response = [ 'status' => false, 'mensaje' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }

    }

    
}
