<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PublicacaoController;

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

                                                //rota dinamica
Route::resource('publicacao', PublicacaoController::class);




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
});





