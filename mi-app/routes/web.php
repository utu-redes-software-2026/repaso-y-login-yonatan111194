<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ruta principal de la aplicación
// Cuando un usuario entra a "/", se muestra la vista 'welcome'
Route::get('/', function () {
    return view('welcome');
});


// Ruta del dashboard (panel principal típico de Laravel)
// Solo pueden acceder usuarios autenticados y con email verificado
Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified']) // 'auth' = usuario logueado, 'verified' = email verificado
->name('dashboard'); // nombre de la ruta para usarla fácilmente


// Grupo de rutas protegidas por autenticación
// Solo usuarios logueados pueden acceder
Route::middleware('auth')->group(function () {

    // Mostrar formulario para editar el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Actualizar la información del perfil (nombre, email, etc.)
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Eliminar la cuenta del usuario
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// Importa todas las rutas de autenticación (login, register, logout, etc.)
// Estas rutas están definidas en el archivo auth.php
require __DIR__.'/auth.php';


// Ruta personalizada protegida
// Solo usuarios autenticados pueden acceder
Route::middleware(['auth'])->get('/panel', function () {

    // Muestra la vista 'panel'
    return view('panel');
});
// Ruta protegida del panel
// Solo usuarios autenticados pueden acceder
Route::middleware(['auth'])->get('/panel', function () {
    // Muestra la vista panel.blade.php
    return view('panel');
});