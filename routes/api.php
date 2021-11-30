<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\VideosController;

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

Route::prefix('usuarios')->group(function(){
    Route::put('/registrar',[UsuariosController::class,'registrar']);
    Route::delete('/desactivar/{id}',[UsuariosController::class,'desactivar']);
    Route::post('/editar/{id}',[UsuariosController::class,'editar']);
    
    Route::get('/listar',[UsuariosController::class,'listar']);
    Route::put('/comprar_curso/{usuarios_id}/{cursos_id}',[UsuariosController::class,'comprar_curso']);
    Route::get('/listar_usuario_curso/{id}',[UsuariosController::class,'listar_usuario_curso']);
});



Route::prefix('cursos')->group(function(){
    Route::put('/crear',[CursosController::class,'crear']);
    
    Route::get('/listar',[CursosController::class,'listar']);
    Route::get('/ver/{id}',[CursosController::class,'ver']);
});

Route::prefix('videos')->group(function(){
    Route::put('/crear',[VideosController::class,'crear']);
    
});