<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator,Hash};
use App\Models\{User};


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $requestUser = collect( $request->usuario )->all(); 
            $validateUser = $this->validateUser( $requestUser );
            $response = [];
            
            if ( $validateUser['status'] ) {
                
                $user = User::where('email', $requestUser['email'])->first();

                if ($user != null) {
                    $hashPassword = Hash::check( $requestUser['password'], $user->password );

                    if($this->validarCheck( $hashPassword, $user->password) ){
                        $user->rol;
                        $user->persona;
                        $token = $user->createToken('API TOKEN')->plainTextToken;
                        
                        $response = [ 'status' => true, 'message' => "Acceso al Sistema", 'data' => $user, 'token' => $token ];
                    }else{
                        $response = [ 'status' => false, 'message' => "Contraseña Incorrecta" ]; 
                    }

                }else{
                    $response = [ 'status' => false, 'message' => "Correo Incorrecto" ];
                }
            } else {
                $response = [ 
                    'status' => false, 
                    'message' => 'No se pudo logear :(',
                    'fails' => [ 
                        'error_user' => $validateUser["error"] ?? "No presenta errores" 
                    ]
                ];    
            }  
            return response()->json( $response, 200 );
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    private function validarCheck($password1, $password2)
    {
        if($password1 == $password2){
            return true;
        }else{
            return false;
        }
    }

    public function validateUser( $request )
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'El campo correo es requerido',
            'email.email' => 'El correo no tiene un formato válido',
            'password.required' => 'El campo contraseña es requerido',
        ];
        return $this->validation( $request, $rules, $messages );
    }

    public function validation( $request, $rules, $messages )
    {
        
        $response = [ 'status' => true, 'message' => 'No hubo errores' ];
        
        $validate = Validator::make( $request, $rules, $messages ); 
       
        if ( $validate->fails() ) {
            $response = [ 'status' => false, 'message' => 'Error de validación', 'error' => $validate->errors() ];
        }
        return $response;
    }

    public function cerrarSesion(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'status' => true,
            'mensaje' => 'Ha cerrado sesion'
        ];
        return response()->json($response);

    }
}
