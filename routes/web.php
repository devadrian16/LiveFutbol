<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\LiveScoreController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PruebasController;

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

//[--HOME--]
Route::get('/', function () { return view('home'); });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//[--LIVESCORE--]
Route::get('/livescore', [LiveScoreController::class, 'verLiveScore']);

//[--LIGAS--]
Route::get('/liga/{league}', [LigaController::class, 'verLiga']);

//[--EQUIPOS--]
Route::get('/equipo/{team}', [EquipoController::class, 'verEquipo']);

//[--PRUEBAS--]
Route::get('/pruebas', [PruebasController::class, 'verPruebas']);
