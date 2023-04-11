<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator,Hash};
use App\Models\{Doctor, User};


class AuthController extends Controller
{

    private $personaCtrl;

    public function __construct()
    {
        $this->personaCtrl = new PersonaController();
    }

    public function login(Request $request)
    {
        try {
            $requestUser = collect( $request->usuario )->all(); 
            $validateUser = $this->validateUserLogin( $requestUser );
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

    public function validateUserLogin( $request )
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

    public function guardarUsuario(Request $request)
    {
        try {
            $requestPersona = collect( $request->persona )->all();
            $requestUsuario = collect( $request->usuario )->all();
            
            $validatePersona = $this->personaCtrl->validatePersona( $requestPersona );
            $validateUsuario = $this->validateUser( $requestUsuario );
            
            if ($validatePersona['status'] && $validateUsuario['status'] ) {
                $responsePersona = $this->personaCtrl->guardarPersona( $requestPersona );
                $persona_id = $responsePersona['persona']->id;

                $encriptarPassword = Hash::make($requestUsuario['password']);

                $user = User::create([
                    'rol_id' => $requestUsuario['rol_id'],
                    'persona_id' => $persona_id,
                    'name' => $requestUsuario['name'],
                    'imagen' => $requestUsuario['imagen'],
                    'email' => $requestUsuario['email'], 
                    'password' => $encriptarPassword
                ]);

                if(intval($requestUsuario['rol_id']) === 2){
                    $newDoctor = new Doctor();
                    $newDoctor->persona_id = $persona_id;
                    $newDoctor->estado = 'A';
                    $newDoctor->save();
                }

                $response = [ 'status' => true, 'mensaje' => "El usuario se registro con exito", 'usuario' => $user ];
            }else {
                $response = [ 
                    'status' => false, 
                    'mensaje' => 'No se pudo crear el usuario',
                    'falla' => [
                        'error_persona' => $validatePersona['error'] ?? 'No presenta errores',
                        'error_usuario' => $validateUsuario['error'] ?? 'No presenta errores'
                    ]
                ]; 
            }
            return response()->json( $response, 200 );
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    public function validateUser( $request )
    {
        $rules = [
            'name'=> 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo usuario es requerido',
            'email.required' => 'El campo correo es requerido',
            'email.email' => 'El correo no tiene un formato válido',
            'password.required' => 'El campo contraseña es requerido',
        ];
        return $this->validation( $request, $rules, $messages );
    }


}
