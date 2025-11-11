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
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('welcome');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas (solo usuarios autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Página principal post-login
    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

    // 🔹 Clientes
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
    Route::prefix('proyectos')->name('proyectos.')->group(function () {
        Route::get('/', [ProyectosController::class, 'index'])->name('index');
        Route::get('/create', [ProyectosController::class, 'create'])->name('create');
        Route::post('/', [ProyectosController::class, 'store'])->name('store');
        Route::get('/{proyecto}', [ProyectosController::class, 'show'])->name('show');
        Route::get('/{proyecto}/edit', [ProyectosController::class, 'edit'])->name('edit');
        Route::put('/{proyecto}', [ProyectosController::class, 'update'])->name('update');
        Route::delete('/{proyecto}', [ProyectosController::class, 'destroy'])->name('destroy');
    });

    // 📄 PDF (solo autenticados)
    Route::get('/pdf/clientes', [ReportePdfController::class, 'clientes'])->name('pdf.clientes');

    // 📄 PDF individual por cliente
    Route::get('/pdf/clientes/{id}', [ReportePdfController::class, 'clienteIndividual'])->name('pdf.cliente');

}); // <-- 👈 CIERRE correcto del grupo protegido


/*
|--------------------------------------------------------------------------
| Rutas de autenticación (públicas)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Autenticación predeterminada
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
