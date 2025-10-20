<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JuridicoController;
use App\Http\Controllers\ConsejosController;

// Dashboard público (página principal)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Vista de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout (opcional, pero útil)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contenido Jurídico (CRUD solo para admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/juridico', [JuridicoController::class, 'index'])->name('juridico.index');
    Route::get('/juridico/create', [JuridicoController::class, 'create'])->name('juridico.create');
    Route::post('/juridico', [JuridicoController::class, 'store'])->name('juridico.store');
    Route::get('/juridico/{id}/edit', [JuridicoController::class, 'edit'])->name('juridico.edit');
    Route::put('/juridico/{id}', [JuridicoController::class, 'update'])->name('juridico.update');
    Route::delete('/juridico/{id}', [JuridicoController::class, 'destroy'])->name('juridico.destroy');
});

// Consejos y contactos (solo lectura)
Route::get('/consejos', [ConsejosController::class, 'index'])->name('consejos.index');

// Chatbot (simulado, solo redirige o muestra una vista simple)
Route::post('/chatbot', function () {
    // Simulación: devolvemos una respuesta fija por ahora
    return response()->json([
        'response' => 'Gracias por tu pregunta. En este momento no tengo acceso a la base de datos completa, pero puedes consultar el contenido jurídico o contactarnos directamente.'
    ]);
})->name('chatbot.submit');