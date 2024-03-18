<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;

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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('index1');
});

//PQR
Route::post('/submit-claim', [ClaimController::class, 'submit'])->name('submitClaim');



//Enviar Correo de PQR
Route::get('/send_mail/{id}', [ClaimController::class, 'send_mail']);
Route::post('/mail/{id}', [ClaimController::class, 'mail'])->name('mail');

//Estado PQR
Route::post('/update-status/{claim}', [ClaimController::class, 'updateStatus'])->name('claim.updateStatus');
Route::post('/update-status/{claim}', [ClaimController::class, 'updateStatus'])->name('claim.updateStatus');

//Contactanos
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

//Mostrar mensajes de la base de datos
Route::get('messages', [MessageController::class, 'index'])->name('messages.index');



Auth::routes();

use App\Http\Middleware\CheckRole;

Route::group(['middleware' => ['auth']], function () {
    // Rutas accesibles para todos los usuarios autenticados
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/acceso-denegado', function () { return view('acceso-denegado'); })->name('acceso-denegado');

    // Rutas accesibles para el rol 2 (Mecánico) y el administrador
    Route::group(['middleware' => [CheckRole::class . ':Mecanico|Admin']], function () {
        Route::resource('tareas', App\Http\Controllers\TareaController::class);
        Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'index'])->name('tarea.index');

        // Agrega otras rutas aquí que ambos roles deberían tener acceso



        Route::middleware('can:create-task')->group(function () {
            Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
            Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
        });

    // Rutas accesibles solo para el administrador
    Route::group(['middleware' => [CheckRole::class . ':Admin']], function () {
        Route::resource('mecanicos', App\Http\Controllers\MecanicoController::class);
        Route::resource('productos', App\Http\Controllers\ProductoController::class);
        Route::resource('servicios', App\Http\Controllers\ServicioController::class);
        Route::resource('vehiculos', App\Http\Controllers\VehiculoController::class);
        Route::resource('clientes', App\Http\Controllers\ClienteController::class);
        Route::resource('ventas', App\Http\Controllers\VentaController::class);
        Route::resource('/usuarios',App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::resource('/usuarios',App\Http\Controllers\Admin\UserController::class)->only('index', 'edit', 'update')->names('admin.users');
        Route::get('mecanicos/pdf',[App\Http\Controllers\MecanicoController::class,'pdf'])->name('mecanico.pdf');
        Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
        Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
        Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');

        // Rutas para ventas
        Route::post('/venta/import', [App\Http\Controllers\VentaController::class, 'import'])->name('venta.import');
        Route::get('/venta/export', [App\Http\Controllers\VentaController::class, 'export'])->name('venta.export');
        Route::get('/venta/pdf', [App\Http\Controllers\VentaController::class, 'pdf'])->name('venta.pdf');

        // Ruta para mostrar la lista de ventas con filtrado
        Route::get('/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('venta.index');

        // Rutas para activar y desactivar ventas
        Route::patch('/ventas/desactivar/{id}', [App\Http\Controllers\VentaController::class, "desactivar"])->name('ventas.desactivar');
        Route::patch('/ventas/activar/{id}', [App\Http\Controllers\VentaController::class, "activar"])->name('ventas.activar');
        Route::get('/activar', [App\Http\Controllers\VentaController::class, "mostrarDesactivadas"])->name('ventas.desactivadas');


        // Rutas para tareas
        Route::post('/tarea/import', [App\Http\Controllers\TareaController::class, 'import'])->name('tarea.import');
        Route::get('/tarea/export', [App\Http\Controllers\TareaController::class, 'export'])->name('tarea.export');
        Route::get('/tarea/pdf', [App\Http\Controllers\TareaController::class, 'pdf'])->name('tarea.pdf');

        // Ruta para mostrar la lista de TAREAS con filtrado

        // Rutas para activar, desactivar y mostrar desactivadas tareas
        Route::patch('/tareas/desactivar/{id}', [App\Http\Controllers\TareaController::class, "desactivar"])->name('tareas.desactivar');
        Route::patch('/tareas/activar/{id}', [App\Http\Controllers\TareaController::class, "activar"])->name('tareas.activar');
        Route::get('/activare', [App\Http\Controllers\TareaController::class, "mostrarDesactivadas"])->name('tareas.desactivadas');

        // Rutas para clientes
        Route::post('/clientes/import', [App\Http\Controllers\ClienteController::class, 'import'])->name('clientes.import');
        Route::get('/exporte', [App\Http\Controllers\ClienteController::class, 'export'])->name('export.clientes');
        Route::get('/cliente/pdf', [App\Http\Controllers\ClienteController::class, 'pdf'])->name('clientes.pdf');

        // Ruta para mostrar la lista de CLIENTES con filtrado
        Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');

        // Rutas para activar, desactivar y mostrar desactivadas clientes
        Route::patch('/clientes/desactivar/{id}', [App\Http\Controllers\ClienteController::class, "desactivar"])->name('clientes.desactivar');
        Route::patch('/clientes/activar/{id}', [App\Http\Controllers\ClienteController::class, "activar"])->name('clientes.activar');
        Route::get('/activa', [App\Http\Controllers\ClienteController::class, "mostrarDesactivadas"])->name('clientes.desactivadas');

        // Rutas para vehículos
        Route::post('/vehiculos/import', [App\Http\Controllers\VehiculoController::class, 'import'])->name('vehiculos.import');
        Route::get('Export', [App\Http\Controllers\VehiculoController::class, 'export'])->name('export.vehiculos');
        Route::get('/vehiculo/pdf', [App\Http\Controllers\VehiculoController::class, 'pdf'])->name('vehiculos.pdf');

        // Ruta para mostrar la lista de VEHICULOS con filtrado
        Route::get('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])->name('vehiculos.index');

        // Rutas para activar, desactivar y mostrar desactivadas vehiculos
        Route::patch('/vehiculos/desactivar/{id}', [App\Http\Controllers\VehiculoController::class, "desactivar"])->name('vehiculos.desactivar');
        Route::patch('/vehiculos/activar/{id}', [App\Http\Controllers\VehiculoController::class, "activar"])->name('vehiculos.activar');
        Route::get('/activia', [App\Http\Controllers\VehiculoController::class, "mostrarDesactivadas"])->name('vehiculos.desactivadas');

        // Rutas para mecánicos
        Route::post('/mecanicos/import', [App\Http\Controllers\MecanicoController::class, 'import'])->name('mecanicos.import');
        Route::get('/exports', [App\Http\Controllers\MecanicoController::class, 'export'])->name('mecanicos.export');
        Route::get('/mecanico/pdf', [App\Http\Controllers\MecanicoController::class, 'pdf'])->name('mecanicos.pdf');

        // Ruta para mostrar la lista de MECANICOS con filtrado
        Route::get('/mecanicos', [App\Http\Controllers\MecanicoController::class, 'index'])->name('mecanicos.index');

        // Rutas para activar, desactivar y mostrar desactivadas mecanicos
        Route::patch('/mecanicos/desactivar/{id}', [App\Http\Controllers\MecanicoController::class, "desactivar"])->name('mecanicos.desactivar');
        Route::patch('/mecanicos/activar/{id}', [App\Http\Controllers\MecanicoController::class, "activar"])->name('mecanicos.activar');
        Route::get('/activias', [App\Http\Controllers\MecanicoController::class, "mostrarDesactivadas"])->name('mecanicos.desactivadas');


        // Rutas para productos
        Route::post('/productos/import', [App\Http\Controllers\ProductoController::class, 'import'])->name('productos.import');
        Route::get('/exportss', [App\Http\Controllers\ProductoController::class, 'export'])->name('productos.export');
        Route::get('/producto/pdf', [App\Http\Controllers\ProductoController::class, 'pdf'])->name('productos.pdf');

        // Ruta para mostrar la lista de PRODUCTOS con filtrado
        Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');

        // Rutas para activar, desactivar y mostrar desactivadas productos
        Route::patch('/productos/desactivar/{id}', [App\Http\Controllers\ProductoController::class, "desactivar"])->name('productos.desactivar');
        Route::patch('/productos/activar/{id}', [App\Http\Controllers\ProductoController::class, "activar"])->name('productos.activar');
        Route::get('/activiase', [App\Http\Controllers\ProductoController::class, "mostrarDesactivadas"])->name('productos.desactivadas');

        // Rutas para servicios
        Route::post('/servicios/import', [App\Http\Controllers\ServicioController::class, 'import'])->name('servicios.import');
        Route::get('/expor', [App\Http\Controllers\ServicioController::class, 'export'])->name('servicios.export');
        Route::get('/servicio/pdf', [App\Http\Controllers\ServicioController::class, 'pdf'])->name('servicios.pdf');

        // Ruta para mostrar la lista de SERVICIOS con filtrado
        Route::get('/servicios', [App\Http\Controllers\ServicioController::class, 'index'])->name('servicios.index');

        // Rutas para activar, desactivar y mostrar desactivadas servicios
        Route::patch('/servicios/desactivar/{id}', [App\Http\Controllers\ServicioController::class, "desactivar"])->name('servicios.desactivar');
        Route::patch('/servicios/activar/{id}', [App\Http\Controllers\ServicioController::class, "activar"])->name('servicios.activar');
        Route::get('/activiaser', [App\Http\Controllers\ServicioController::class, "mostrarDesactivadas"])->name('servicios.desactivadas');


        Route::resource('/usuarios', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::resource('/usuarios', App\Http\Controllers\Admin\UserController::class)->only('index', 'edit', 'update')->names('admin.users');
    });
});
});
