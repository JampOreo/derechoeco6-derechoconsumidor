<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JuridicoController;
use App\Http\Controllers\ConsejosController;

// Dashboard público
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contenido Jurídico: acceso público al índice
Route::get('/juridico', [JuridicoController::class, 'index'])->name('juridico.index');

// CRUD protegido solo para admin
Route::middleware(['auth'])->group(function () {
    Route::get('/juridico/create', [JuridicoController::class, 'create'])->name('juridico.create');
    Route::post('/juridico', [JuridicoController::class, 'store'])->name('juridico.store');
    Route::get('/juridico/{juridico}/edit', [JuridicoController::class, 'edit'])->name('juridico.edit');
    Route::put('/juridico/{juridico}', [JuridicoController::class, 'update'])->name('juridico.update');
    Route::delete('/juridico/{juridico}', [JuridicoController::class, 'destroy'])->name('juridico.destroy');
});

// Consejos y contactos
Route::get('/consejos', [ConsejosController::class, 'index'])->name('consejos.index');

// Chatbot (pública, POST)
Route::post('/chatbot', [DashboardController::class, 'chatbot'])->name('chatbot');