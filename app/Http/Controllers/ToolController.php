<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;



class ToolController extends Controller
{
    public function mostrarImagen($carpeta,$archivo){
        try {
            $existeArchivo = Storage::disk($carpeta)->exists($archivo);
            $response = [];

            if($existeArchivo){
                $file = Storage::disk($carpeta)->get($archivo);
                return new Response($file,200);
            }else{
                $response=[
                    'status' => false,
                    'mensaje' => 'No existe la imagen',
                    'imagen' => null
                ];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
        
    }

    
}
