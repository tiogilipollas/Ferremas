<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransbankController;


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

Route::post('/iniciar_compra',[TransbankController::class,'iniciar_compra']);
Route::post('/confirmar_pago',[TransbankController::class,'confirmar_pago'])->name('confirmar_pago');
