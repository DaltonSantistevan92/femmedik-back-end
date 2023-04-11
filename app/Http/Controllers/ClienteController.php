<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\{Cliente};

class ClienteController extends Controller
{
    public function buscarClientes($cedula){
        $response = []; 
        $texto = strtolower($cedula);

        $clientes = Cliente::select('clientes.id as cliente_id','clientes.email','personas.cedula','personas.nombre','personas.apellido','personas.celular', 'personas.telefono','personas.direccion')
                            ->where('personas.cedula', 'like', '%' . $texto . '%')
                            ->join('personas','clientes.persona_id','=','personas.id')
                            ->get();
        
        if (count($clientes) > 0) {
            $response = [
                'status' => true,
                'mensaje' => 'Concidencias encontradas',
                'clientes' => $clientes
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No hay registro',
                'clientes' => null
            ];
        }
        return response()->json($response);
    }
}
