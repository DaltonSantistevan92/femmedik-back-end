<?php

use App\Http\Controllers\{AuthController, ClienteController, MenuController, RolController, ToolController, UserController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//RUTAS PUBLICAS
Route::post('login', [ AuthController::class, 'login'] );

Route::get('buscarCedula/{cedula}', [ ClienteController::class, 'buscarClientes']);


//RUTAS PROTEGIDAS POR TOKEN
Route::group(['middleware' => ['auth:sanctum']], function() {

    //ruta de menu
    Route::get('menu/{rol_id}/{id_seccion}',[ MenuController::class, 'mostrarMenu' ]);

    //ruta de usuario
    Route::get('usuario/contar', [ UserController::class, 'contarUsuario' ]);

    //rutas de roles
    Route::get('rol/contar',[ RolController::class, 'contarRol' ]);
    
    //rutas de cerrar Sesion
    Route::post('cerrar-sesion',[ AuthController::class, 'cerrarSesion' ]);
});


//RUTAS POR CORS DE ARCHIVOS
Route::group(['middleware' => ['cors']], function () {
    Route::get('getImg/{carpeta}/{archivo}',[ ToolController::class, 'mostrarImagen' ]);
});



