<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/riwayat', [DashboardController::class, 'riwayat']);
Route::get('/profile', [DashboardController::class, 'profile']);
Route::post('/profile', [DashboardController::class, 'updateProfile']);
Route::get('/deposito', [DepositoController::class, 'deposito']);
Route::post('/deposito', [DepositoController::class, 'store']);

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/audit-log', [AdminController::class, 'auditLog']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser']);
    Route::put('/users/{id}', [AdminController::class, 'updateUser']);
});
