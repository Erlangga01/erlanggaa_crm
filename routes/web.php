<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Leads (Sales)
    Route::resource('leads', \App\Http\Controllers\LeadController::class);

    // Products (Master)
    Route::resource('products', \App\Http\Controllers\ProductController::class);

    // Projects (Process)
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
    Route::post('projects/{project}/approve', [\App\Http\Controllers\ProjectController::class, 'approve'])->name('projects.approve');
    Route::post('projects/{project}/finish', [\App\Http\Controllers\ProjectController::class, 'finishInstallation'])->name('projects.finish');

    // Customers (Subscription)
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);

    // Manager only example
    // Route::middleware('manager')->group(function() { ... });
});
