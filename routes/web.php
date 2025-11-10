<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Clientes\ClientesController;
use App\Http\Controllers\Proyectos\ProyectosController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ReportePdfController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
|
| Si el usuario está autenticado, se le redirige al panel principal (Welcome).
| Si no, se le envía al formulario de login.
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('welcome');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas (solo para usuarios autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Página principal post-login (usa el controlador WelcomeController)
    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

    // 🔹 Grupo de rutas para clientes
    Route::prefix('clientes')->name('clientes.')->group(function () {
        Route::get('/', [ClientesController::class, 'index'])->name('index');
        Route::get('/create', [ClientesController::class, 'create'])->name('create');
        Route::post('/', [ClientesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ClientesController::class, 'edit'])->name('edit');
        Route::put('/{cliente}', [ClientesController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ClientesController::class, 'delete'])->name('delete');
        Route::delete('/{cliente}', [ClientesController::class, 'destroy'])->name('destroy');
    });

    // 🔹 Proyectos
    Route::get('/proyectos/index', [ProyectosController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/simulacion', [ProyectosController::class, 'simulacion'])->name('proyectos.simulacion');
    Route::post('/proyectos/simulacion', [ProyectosController::class, 'calcularSimulacion'])->name('proyectos.simulacion.calcular');
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación (login, logout)
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Carga del sistema de autenticación predeterminado
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

// Ruta para generar PDF
Route::get('/pdf/clientes', [ReportePdfController::class, 'clientes'])->name('pdf.clientes');
