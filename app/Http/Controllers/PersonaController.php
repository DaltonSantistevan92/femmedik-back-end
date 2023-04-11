<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator,Hash};


class PersonaController extends Controller
{

    public function validatePersona( $request )
    {
        $rules = [
            'cedula' => 'required|unique:personas,cedula',
            'nombre' => 'required',
            'apellido' => 'required'
        ];

        $messages = [
            'cedula.required' => 'El campo cedula es requerido',
            'cedula.unique' => 'La cedula ya existe',
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
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
    
    public function guardarPersona( $data ){
        $response = [];

        if (count($data) > 0 ) {
            $persona = new Persona();
            $persona->cedula = $data['cedula'];
            $persona->nombre = $data['nombre'];
            $persona->apellido = $data['apellido'];
            $persona->celular = $data['celular'];
            $persona->telefono = $data['telefono'];
            $persona->direccion = $data['direccion'];
            $persona->estado = 'A';

            if ($persona->save()) {
                $response = [ 'status'=> true, 'mensaje' => 'Se registro con exito', 'persona' => $persona ];
            }else{
                $response = [ 'status'=> false, 'mensaje' => 'No se pudo registrar'];
            }
        }else {
            $response = [ 'status'=> false, 'mensaje' => 'No existe data'];
        }
        return $response;
    }
}
