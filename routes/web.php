<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgregarProductosController;
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

Route::get('/', [InicioController::class, 'index'])->name('index');

Route::get('/materiales', [ProductoController::class, 'index'])->name('materiales');

Route::get('/herramientas', [HerramientasController::class, 'index'])->name('herramientas');

Route::get('/equipos', [EquiposController::class, 'index'])->name('equipos');



Auth::routes();


// Ruta que guarda los datos del cliente
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::post('/home', [HomeController::class, 'store'])->name('home.store');


// Ruta que edita los datos del cliente

Route::put('/home/update/{id_cliente}', [ClienteController::class, 'update'])->name('home.update');

Route::DELETE('/home/destroy/{id_cliente}', [ClienteController::class, 'destroy'])->name('home.destroy');

Route::get('/agregarproductos', [AgregarProductosController::class, 'create'])->name('agregarproductos.create');