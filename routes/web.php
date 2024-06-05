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
use App\Http\Controllers\ConfirmarPagoController;


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

Route::post('/confirmar_pago', [ConfirmarPagoController::class, 'confirmar_pago'])->name('confirmar_pago');


Route::get('/rechazo', function () { return view('rechazo');})->name('rechazo');


Route::get('/pago', [PaymentController::class, 'showPaymentPage'])->name('pago');

Route::post('/api/iniciar_compra', [TransbankController::class, 'iniciar_compra'])->name('iniciar_compra');
Route::get('/confirmacion', [TransbankController::class, 'confirmar_pago'])->name('confirmar_pago');
Route::post('/webpay_plus_response', 'TransbankController@handleResponse')->name('webpay_plus_response');


Auth::routes();


// Ruta que guarda los datos del cliente
Route::post('/home', [HomeController::class, 'store'])->name('home.store');


// Ruta que edita los datos del cliente

Route::put('/home/update/{rut}', [ClienteController::class, 'update'])->name('home.update');

Route::DELETE('/home/destroy/{rut}', [ClienteController::class, 'destroy'])->name('home.destroy');


Route::group(['middleware' => ['auth', 'checkusertype:Vendedor,Bodeguero,Administrador']], function () {
    Route::get('/agregarproductos', [AgregarProductosController::class, 'create'])->name('agregarproductos.create');
    Route::post('/agregarproductos', [AgregarProductosController::class, 'store'])->name('agregarproductos.store');
    Route::get('/adminindex', [AgregarProductosController::class, 'index'])->name('adminindex');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('clientes', ClienteController::class);
});

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


Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');


Route::get('/productos/{ID_producto}', 'App\Http\Controllers\ProductoController@show')->name('productos.show');
