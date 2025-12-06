<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\QuienesSomosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ProyectosUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController; // Nueva importación

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->middleware('track.views');
Route::get('/contacto', [ContactoController::class, 'showForm'])->middleware('track.views');
Route::post('/contacto', [ContactoController::class, 'store']);
Route::get('/consultar-ruc/{ruc}', [ContactoController::class, 'consultarRuc']);
Route::get('/quienes-somos', [QuienesSomosController::class, 'index'])->name('quienes-somos.index')->middleware('track.views');
Route::get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index')->middleware('track.views');
Route::get('/proyectosUs', [ProyectosUserController::class, 'index'])->name('proyectos.user.index')->middleware('track.views');

// Ruta para clientes (dashboard de usuario)
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// Rutas del panel de administración, protegidas por el middleware 'is.admin'
Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/admin/proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
    Route::post('/admin/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::get('/admin/proyectos/{proyecto}/editar', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('/admin/proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::delete('/admin/proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
    Route::get('/admin/solicitudes', [ContactoController::class, 'index'])->name('admin.solicitudes.index');
    Route::get('/admin/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');

     Route::post('/admin/clientes/{user}/toggle-verification', [ClienteController::class, 'toggleVerification'])->name('clientes.toggleVerification');
});

require __DIR__.'/auth.php';