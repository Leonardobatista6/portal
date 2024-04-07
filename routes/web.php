<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MeusPortsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PublicacaoController;
// web.php ou api.php
use App\Http\Controllers\EditorController;
use Intervention\Image\Laravel\Facades\Image;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/portal', function () {
    return Inertia::render('Portal');
})->name('portal');

Route::get('/noticiasnacionais', function () {
    return Inertia::render('NoticiasNacionais');
})->name('nnacionais');
Route::get('/politica', function () {
    return Inertia::render('Politica');
})->name('politica');
Route::get('/economia', function () {
    return Inertia::render('Economia');
})->name('economia');

Route::get('/esportes', function () {
    return Inertia::render('Esportes');
})->name('esportes');

Route::get('/noticiaslocal', function () {
    return Inertia::render('NoticiasLocal');
})->name('noticiaslocal');

Route::get('/entretenimento', function () {
    return Inertia::render('Entretenimento');
})->name('entretenimento');


// rota para salvar publicação
Route::post('/salvar-conteudo', [EditorController::class, 'salvarConteudo']);


//rota teste
Route::get('/teste2', [\App\Http\Controllers\MeusPortsController::class, 'show']);
Route::get('/teste', function () {
    return Inertia::render('Edit');
})->name('edit');


//rota teste 2
Route::get('/editor', function () {
    return Inertia::render('Editor');
})->name('editor');

                                  //rota para imagens
///Route::apiResource('/file', FileController::class,);
 Route::Post('/file', [FileController::class, 'store']);
Route::Post('/file/principal', [FileController::class, 'imagemPrincipal']);
Route::get('/file/getimagens', [FileController::class, 'getAllImages']);
Route::get('/file/imgprincipal', [FileController::class, 'getPrincipal']);
Route::delete('/file/{id}', [FileController::class, 'destroy']);
Route::delete('/principal/{id}', [FileController::class, 'destroyPrincipal']);


                                                //rota dinamica
Route::resource('publicacao', PublicacaoController::class);
Route::resource('publi', MeusPortsController::class);

//routa para imagens
Route::Get('/foto', [FileController::class, 'salvar']);
//Route::get('/imagens', function () {
  //  $image = Image::read('/public/imagens');
//});



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/ports', function () {
        return Inertia::render('Ports');
    })->name('ports');
    Route::get('/imagem', function () {
        return Inertia::render('PageImagem');
    })->name('imagem');
});





