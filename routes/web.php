<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\CheckRole;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Frontend Views protected by auth
Route::middleware('auth')->group(function () {
    Route::get('/customer', function () {
        return view('customer');
    })->name('customer.dashboard');

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin.dashboard');
});

// API Endpoints
Route::prefix('api')->group(function () {
    // Both Customers and Admins can list and submit tickets
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);
    
    // Protected Admin-only actions
    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::patch('/tickets/{ticket}/resolve', [TicketController::class, 'resolve']);
    });
});