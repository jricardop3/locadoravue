<?php

use App\Http\Controllers\CarroController;
use App\Http\Controllers\LocacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::ApiResource('carro', CarroController::class);
Route::ApiResource('cliente', ClienteController::class);
Route::apiResource('locacao', LocacaoController::class);
Route::apiResource('marca', MarcaController::class);
Route::apiResource('modelo', ModeloController::class);