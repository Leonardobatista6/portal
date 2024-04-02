<?php

use App\Http\Controllers\EconomiaController;
use App\Http\Controllers\EsporteController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MeusPortsController;
use App\Http\Controllers\NoticiasNacionaisController;
use App\Http\Controllers\PoliticaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/file', FileController::class,);

Route::apiResource('/noticiasnacionais', NoticiasNacionaisController::class,);
Route::apiResource('/politica', PoliticaController::class,);
Route::apiResource('/esporte', EsporteController::class,);
Route::apiResource('/economia', EconomiaController::class,);
Route::apiResource('/ports',MeusPortsController::class,);
