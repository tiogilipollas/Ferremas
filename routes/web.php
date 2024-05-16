<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\HerramientasController; 
use App\Http\Controllers\EquiposController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [InicioController::class, 'index'])->name('index');

Route::get('/materiales', [ProductoController::class, 'index'])->name('materiales');

Route::get('/herramientas', [HerramientasController::class, 'index'])->name('herramientas');

Route::get('/equipos', [EquiposController::class, 'index'])->name('equipos');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');