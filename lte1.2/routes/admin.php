<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('mecanicos/pdf',[App\Http\Controllers\MecanicoController::class,'pdf'])->name('mecanico.pdf');
Route::resource('mecanicos', App\Http\Controllers\MecanicoController::class)->Middleware('auth');

Route::resource('productos', App\Http\Controllers\ProductoController::class)->Middleware('auth');

Route::resource('servicios', App\Http\Controllers\ServicioController::class)->Middleware('auth');

Route::resource('vehiculos', App\Http\Controllers\VehiculoController::class)->Middleware('auth');

Route::resource('clientes', App\Http\Controllers\ClienteController::class)->Middleware('auth');

Route::resource('tareas', App\Http\Controllers\TareaController::class)->Middleware('auth');

Route::resource('ventas', App\Http\Controllers\VentaController::class)->Middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Roles
Route::resource('/usuarios',App\Http\Controllers\Admin\UserController::class)->only('index', 'edit', 'update')->names('admin.users');
