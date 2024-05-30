<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\HerramientasController; 
use App\Http\Controllers\EquiposController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AgregarProductosController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransbankController;


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

Route::get('/materiales', [MaterialesController::class, 'index'])->name('materiales');

Route::get('/herramientas', [HerramientasController::class, 'index'])->name('herramientas');

Route::get('/equipos', [EquiposController::class, 'index'])->name('equipos');

Route::get('/inicio', [InicioController::class, 'inicio'])->name('inicio');



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);



Route::get('/pago', [PaymentController::class, 'showPaymentPage'])->name('pago');

Route::post('/api/iniciar_compra', [TransbankController::class, 'iniciar_compra'])->name('iniciar_compra');
Route::get('/webpay/confirmacion', [TransbankController::class, 'confirmar_pago'])->name('confirmar_pago');

Auth::routes();


// Ruta que guarda los datos del cliente
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::post('/home', [HomeController::class, 'store'])->name('home.store');


// Ruta que edita los datos del cliente

Route::put('/home/update/{id_cliente}', [ClienteController::class, 'update'])->name('home.update');

Route::DELETE('/home/destroy/{id_cliente}', [ClienteController::class, 'destroy'])->name('home.destroy');


Route::get('/agregarproductos', [AgregarProductosController::class, 'create'])->name('agregarproductos.create');
Route::post('/agregarproductos', [AgregarProductosController::class, 'store'])->name('agregarproductos.store');

Route::prefix('gestionproductos')->group(function () {
    Route::get('/{categoria?}', [ProductoController::class, 'listar'])->name('productos.listar');
    Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});


Route::get('/administracionproductos', [ProductoController::class, 'listaadmin'])->name('administracionproductos.listaadmin');
Route::delete('/administracionproductos/{id}', [ProductoController::class, 'destroyadmin'])->name('administracionproductos.destroy');
Route::get('/administracionproductos/{id}/edit', [ProductoController::class, 'editadmin'])->name('administracionproductos.editadmin');
Route::put('/administracionproductos/{id}', [ProductoController::class, 'updateadmin'])->name('administracionproductos.updateadmin');