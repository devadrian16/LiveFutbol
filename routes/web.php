<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\LiveScoreController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\FavoritosController;


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

/*
|--------------------------------------------------------------------------
| Helps
|--------------------------------------------------------------------------
|
| Fortify.php to redirect after login.
|
*/

//[--HOME--]
Route::get('/', function () { return view('home'); })->name('home');

//[--JETSTREAM--]
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require_once __DIR__ . '/jetstream.php';

//[--LIVESCORE--]
Route::get('/livescore', [LiveScoreController::class, 'verLiveScore']);

//[--FAVORITOS--]
Route::get('/favoritos', [FavoritosController::class, 'verFavoritos']);

//[--LIGAS--]
Route::get('/liga/{league}', [LigaController::class, 'verLiga']);

//[--EQUIPOS--]
Route::get('/equipo/{team}', [EquipoController::class, 'verEquipo'])->name('verEquipo');
Route::get('/save/{team}', [EquipoController::class, 'guardarEquipoFav']);
Route::get('/delete/{team}', [EquipoController::class, 'eliminarEquipoFav']);

//[--PRUEBAS--]
Route::get('/pruebas', [PruebasController::class, 'verPruebas']);


